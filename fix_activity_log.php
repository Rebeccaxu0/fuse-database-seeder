<?php
// Fix the fuse_activity_log before we import it into the new DB.

// Anamolous data was observed when importing data initially.
// Primarily in the `afilliated_studios` column. Likely due to
// faulty implementation of populating the column when it was
// added well after the table was already created.

$user = 'fuse';
$pass = 'T8Kfec7WZdQb7RXJ';
$dbh = new PDO('mysql:host=localhost;dbname=fuse', $user, $pass);

// 0. Clean obvious error entries and destroy OGGO in the log.
$delete_nulls_q = <<<SQL
DELETE FROM fuse_activity_log WHERE activity_type = '' OR uid = 96176;
SQL;
$result = $dbh->query($delete_nulls_q);
print "{$result->rowCount()} rows of no activity deleted\n";

// 1. Add flag column to mark a row as having been processed.
if (!count($dbh->query("SHOW COLUMNS FROM `fuse_activity_log` LIKE 'processed'")->fetchAll())) {
  $add_col_q = <<<MYSQL
ALTER TABLE fuse_activity_log ADD processed TINYINT UNSIGNED DEFAULT 0;
CREATE INDEX fuse_Activity_log_processed_IDX USING BTREE ON fuse_activity_log (processed);
MYSQL;
  $result = $dbh->query($add_col_q);
  print "Added column;\n{$result->rowCount()} rows affected\n";
}

$limit = 5000;
$users_q =<<<SQL
SELECT DISTINCT(uid)
FROM fuse.fuse_activity_log fal
WHERE processed = 0 AND is_facilitator = 0
-- WHERE uid = 2380
ORDER BY uid
-- LIMIT {$limit};
SQL;

$activity_q =<<<SQL
SELECT * FROM fuse_activity_log
WHERE uid = :uid
ORDER BY timestamp ASC, activity_type DESC
SQL;

$update_studio_nid_q =<<<SQL
UPDATE fuse_activity_log
SET studio_nid = :studio_nid
WHERE uid = :uid AND ISNULL(studio_nid)
AND timestamp <= :t_max
SQL;

$update_affiliated_studios_q =<<<SQL
UPDATE fuse_activity_log
SET processed = 1, affiliated_studios = :studios
WHERE uid = :uid
AND timestamp >= :t_min AND Timestamp <= :t_max
SQL;

$update_processed_q =<<<SQL
UPDATE fuse_activity_log
SET processed = 1
WHERE uid = :uid
SQL;

$sth = $dbh->prepare($users_q);
$sth->execute();
$users = $sth->fetchAll();
$sth->closeCursor();
// 2. For each user:
foreach ($users as $user) {
  print "USER {$user['uid']}\n";
  $sth = $dbh->prepare($activity_q);
  $sth->bindParam(':uid', $user['uid'], PDO::PARAM_INT);
  $sth->execute();
  $activities = $sth->fetchAll();
  $sth->closeCursor();
  $epoch = $current_studios = [];
  $n = 0;
  $ts = 0;
  $sth = $dbh->prepare($update_studio_nid_q);
  foreach ($activities as $activity) {
    $ts = $activity['timestamp'];
    $current_studios_string = implode(',', $current_studios);
    if (empty($epoch)) {
      $epoch[0] = [
        't_start' => $ts,
        't_end' => $ts,
        'studios' => '',
      ];
    }
    if (!empty($activity['studio_nid'])) {
      $sth->bindParam(':uid', $user['uid'], PDO::PARAM_INT);
      $sth->bindParam(':studio_nid', $activity['studio_nid'], PDO::PARAM_INT);
      $sth->bindParam(':t_max', $ts, PDO::PARAM_INT);
      $sth->execute();
      $current_studios[$activity['studio_nid']] = $activity['studio_nid'];
      $current_studios_string = implode(',', $current_studios);

      if ($epoch[0]['studios'] == '') {
        $epoch[0]['studios'] = $current_studios_string;
      }
      if ($activity['activity_type'] == 'studio_remove') {
        $epoch[$n]['t_end'] = $ts - 1;
        unset($current_studios[$activity['studio_nid']]);
        $current_studios_string = implode(',', $current_studios);
        $n++;
        $epoch[$n] = [
          't_start' => $ts,
          't_end' => $ts,
          'studios' => $current_studios_string,
        ];
      }
      else if (end($epoch)['studios'] != $current_studios_string) {
        $last = end($epoch)['studios'];
        $n++;
        $epoch[$n] = [
          't_start' => $ts,
          't_end' => $ts,
          'studios' => $current_studios_string,
        ];
      }
    }
  }
  $sth->closeCursor();
  $sth = $dbh->prepare($update_affiliated_studios_q);
  foreach ($epoch as $k => $v) {
    if (!empty($v['studios'])
      && ($v['t_start'] != $v['t_end'] || $ts == $v['t_end'])) {
      $sth->bindParam(':studios', $v['studios'], PDO::PARAM_STR);
      $sth->bindParam(':uid', $user['uid'], PDO::PARAM_INT);
      $sth->bindParam(':t_min', $v['t_start'], PDO::PARAM_INT);
      $sth->bindParam(':t_max', $v['t_end'], PDO::PARAM_INT);
      $sth->execute();
    }
  }
  $sth->closeCursor();
  $sth = $dbh->prepare($update_processed_q);
  $sth->bindParam(':uid', $user['uid'], PDO::PARAM_INT);
  $sth->execute();
  $sth->closeCursor();
}

print "\nThat's all, folks!\n";

$sth = null;
$dbh = null;