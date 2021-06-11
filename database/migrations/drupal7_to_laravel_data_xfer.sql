-- Insert Challenge Taxonomy Terms
INSERT INTO fuse_laravel.challenges (name, description, d7_id)
SELECT name, description, tid as d7_id from fuse.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT fuse.taxonomy_vocabulary.vid
FROM fuse.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenges')
)
ORDER BY name;

-- Insert Packages
INSERT INTO fuse_laravel.packages (created_at, updated_at, name, description, student_activity_tab_access, d7_id)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), n.title, fdb.body_value, fdfsat.field_student_activity_tab_value, n.nid as d7_id
FROM fuse.node AS n
LEFT JOIN fuse.field_data_body AS fdb ON
  (fdb.entity_type = 'node'
  AND fdb.bundle = 'package'
  AND fdb.entity_id = n.nid)
LEFT JOIN fuse.field_data_field_student_activity_tab AS fdfsat ON
  (fdfsat.entity_type = 'node'
  AND fdfsat.bundle = 'package'
  AND fdfsat.entity_id = n.nid)
WHERE n.type = 'package';

-- Package Challenges
INSERT INTO fuse_laravel.challenge_package (challenge_id, package_id, d7_challenge_id, d7_package_id)
SELECT 1, 1, field_package_challenges_term_target_id, entity_id
FROM fuse.field_data_field_package_challenges_term
WHERE entity_type = 'node' AND bundle = 'package';

-- Update foreign keys
UPDATE fuse_laravel.challenge_package pivot
LEFT JOIN fuse_laravel.challenges c ON pivot.d7_challenge_id = c.d7_id
LEFT JOIN fuse_laravel.packages p ON pivot.d7_package_id = p.d7_id
SET pivot.challenge_id = c.id, pivot.package_id = p.id;

-- Insert Challenge Versions
INSERT INTO fuse_laravel.challenge_versions (name, challenge_id, d7_id, d7_challenge_id, created_at, updated_at)
SELECT n.title as name, 1 as challenge_id, n.nid as d7_id, ttd.tid as d7_challenge_id, FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed)
FROM fuse.node AS n
LEFT JOIN fuse.field_data_field_version_of AS fdfvo ON
  (fdfvo.entity_type = 'node'
  AND fdfvo.bundle = 'challenge'
  AND fdfvo.entity_id = n.nid)
JOIN fuse.taxonomy_term_data ttd
  ON ttd.tid = fdfvo.field_version_of_target_id
WHERE n.type = 'challenge'
ORDER BY n.title ASC;

-- Update foreign keys
UPDATE fuse_laravel.challenge_versions cv
LEFT JOIN fuse_laravel.challenges c ON cv.d7_challenge_id = c.d7_id
SET cv.challenge_id = c.id;

-- Insert Levels
INSERT INTO fuse_laravel.levels (created_at, updated_at, challenge_version_id, d7_id, d7_challenge_version_id)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), 1, n.nid as d7_id, fdfc.field_challenge_nid
FROM fuse.node AS n
LEFT JOIN fuse.field_data_field_challenge AS fdfc ON
  (fdfc.entity_type = 'node'
  AND fdfc.bundle = 'level'
  AND fdfc.entity_id = n.nid)
WHERE n.type = 'level'AND !ISNULL(fdfc.field_challenge_nid)
ORDER BY fdfc.field_challenge_nid ASC;

-- Update foreign keys
UPDATE fuse_laravel.levels levels
LEFT JOIN fuse_laravel.challenge_versions cv ON levels.d7_challenge_version_id = cv.d7_id
SET levels.challenge_version_id = cv.id
WHERE !ISNULL(cv.id);