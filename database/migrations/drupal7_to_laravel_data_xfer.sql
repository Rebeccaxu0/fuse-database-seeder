-- Run search and replace on target database `fuse_laravel_test` if necessary.
-- Add temp D7 migration columns.
ALTER TABLE fuse_laravel_test.users ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_categories ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenges ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_versions ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_versions ADD d7_challenge_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_versions ADD d7_challenge_category_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_versions ADD d7_prereq_challenge_id BIGINT UNSIGNED NULL;
ALTER TABLE fuse_laravel_test.levels ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.levels ADD d7_challenge_version_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.packages ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_package ADD d7_challenge_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.challenge_package ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.roles ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.role_user ADD d7_rid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.role_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.artifacts ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.districts ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.districts ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.district_user ADD d7_district_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.district_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.schools ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.schools ADD d7_district_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.schools ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.school_user ADD d7_school_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.school_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.studios ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.studios ADD d7_school_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.studios ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.studio_user ADD d7_studio_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.studio_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.ideas ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.idea_inspirations ADD d7_idea_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.idea_inspirations ADD d7_challenge_version_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.comments ADD d7_artifact_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.comments ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.comment_seen ADD d7_comment_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.comment_seen ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.partners ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE fuse_laravel_test.schools ADD d7_partner_id BIGINT UNSIGNED DEFAULT 1;

-- Insert Challenge Taxonomy Terms
INSERT INTO fuse_laravel_test.challenges (name, description, d7_id)
SELECT name, description, tid as d7_id from fuse.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT fuse.taxonomy_vocabulary.vid
FROM fuse.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenges')
)
ORDER BY name;

-- Insert Challenge Category Taxonomy Terms
INSERT INTO fuse_laravel_test.challenge_categories (name, description, d7_id)
SELECT name, description, tid as d7_id from fuse.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT fuse.taxonomy_vocabulary.vid
FROM fuse.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenge_categories')
)
ORDER BY name;

-- Insert Packages
INSERT INTO fuse_laravel_test.packages (created_at, updated_at, name, description, student_activity_tab_access, d7_id)
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
INSERT INTO fuse_laravel_test.challenge_package (challenge_id, package_id, d7_challenge_id, d7_package_id)
SELECT 1, 1, field_package_challenges_term_target_id, entity_id
FROM fuse.field_data_field_package_challenges_term
WHERE entity_type = 'node' AND bundle = 'package';

-- Update foreign keys
UPDATE fuse_laravel_test.challenge_package pivot
LEFT JOIN fuse_laravel_test.challenges c ON pivot.d7_challenge_id = c.d7_id
LEFT JOIN fuse_laravel_test.packages p ON pivot.d7_package_id = p.d7_id
SET pivot.challenge_id = c.id, pivot.package_id = p.id;

-- Insert Challenge Versions
INSERT INTO fuse_laravel_test.challenge_versions (
  name,
  challenge_id, challenge_category_id,
  blurb, summary,
  d7_id, d7_challenge_id, d7_challenge_category_id, d7_prereq_challenge_id,
  created_at, updated_at
)
SELECT
  JSON_OBJECT("en", n.title), 1, 1,
  JSON_OBJECTAGG(fdfb.`language` , fdfb.field_blurb_value),
  JSON_OBJECTAGG(fdb.`language`, fdb.body_value),
  n.nid, challenge_ttd.tid, challenge_category_ttd.tid, fdfpc.field_prerequisite_challenges_nid,
  FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed)
FROM fuse.node AS n
LEFT JOIN fuse.field_data_field_blurb fdfb ON
  fdfb.entity_type = 'node'
  AND fdfb.bundle = 'challenge'
  AND fdfb.entity_id = n.nid
LEFT JOIN fuse.field_data_body fdb ON
  fdb.entity_type = 'node'
  AND fdb.bundle = 'challenge'
  AND fdb.entity_id = n.nid
LEFT JOIN fuse.field_data_field_version_of AS fdfvo ON
  (fdfvo.entity_type = 'node'
  AND fdfvo.bundle = 'challenge'
  AND fdfvo.entity_id = n.nid)
JOIN fuse.taxonomy_term_data challenge_ttd
  ON challenge_ttd.tid = fdfvo.field_version_of_target_id
LEFT JOIN fuse.field_data_field_challenge_category AS fdfcc ON
  (fdfcc.entity_type = 'node'
  AND fdfcc.bundle = 'challenge'
  AND fdfcc.entity_id = n.nid)
JOIN fuse.taxonomy_term_data challenge_category_ttd
  ON challenge_category_ttd.tid = fdfcc.field_challenge_category_tid
LEFT JOIN fuse.field_data_field_prerequisite_challenges AS fdfpc ON
  (fdfpc.entity_type = 'node'
  AND fdfpc.bundle = 'challenge'
  AND fdfpc.entity_id = n.nid)
WHERE n.type = 'challenge'
GROUP BY n.nid
ORDER BY n.title ASC;

-- Update foreign keys
UPDATE fuse_laravel_test.challenge_versions cv
LEFT JOIN fuse_laravel_test.challenges c ON cv.d7_challenge_id = c.d7_id
LEFT JOIN fuse_laravel_test.challenge_categories cc ON cv.d7_challenge_category_id = cc.d7_id
SET cv.challenge_id = c.id, cv.challenge_category_id = cc.id;

-- Insert Levels
INSERT INTO fuse_laravel_test.levels (created_at, updated_at, challenge_version_id, d7_id, d7_challenge_version_id)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), 1, n.nid as d7_id, fdfc.field_challenge_nid
FROM fuse.node AS n
LEFT JOIN fuse.field_data_field_challenge AS fdfc ON
  (fdfc.entity_type = 'node'
  AND fdfc.bundle = 'level'
  AND fdfc.entity_id = n.nid)
WHERE n.type = 'level'AND !ISNULL(fdfc.field_challenge_nid)
ORDER BY fdfc.field_challenge_nid ASC;

-- Update foreign keys
UPDATE fuse_laravel_test.levels levels
LEFT JOIN fuse_laravel_test.challenge_versions cv ON levels.d7_challenge_version_id = cv.d7_id
SET levels.challenge_version_id = cv.id
WHERE !ISNULL(cv.id);

--Drop temp D7 migration columns.
ALTER TABLE fuse_laravel_test.users DROP d7_id;
ALTER TABLE fuse_laravel_test.challenge_categories DROP d7_id;
ALTER TABLE fuse_laravel_test.challenges DROP d7_id;
ALTER TABLE fuse_laravel_test.challenge_versions DROP d7_id;
ALTER TABLE fuse_laravel_test.challenge_versions DROP d7_challenge_id;
ALTER TABLE fuse_laravel_test.challenge_versions DROP d7_challenge_category_id;
ALTER TABLE fuse_laravel_test.challenge_versions DROP d7_prereq_challenge_id;
ALTER TABLE fuse_laravel_test.levels DROP d7_id;
ALTER TABLE fuse_laravel_test.levels DROP d7_challenge_version_id;
ALTER TABLE fuse_laravel_test.packages DROP d7_id;
ALTER TABLE fuse_laravel_test.challenge_package DROP d7_challenge_id;
ALTER TABLE fuse_laravel_test.challenge_package DROP d7_package_id;
ALTER TABLE fuse_laravel_test.roles DROP d7_id;
ALTER TABLE fuse_laravel_test.role_user DROP d7_rid;
ALTER TABLE fuse_laravel_test.role_user DROP d7_uid;
ALTER TABLE fuse_laravel_test.artifacts DROP d7_id;
ALTER TABLE fuse_laravel_test.districts DROP d7_id;
ALTER TABLE fuse_laravel_test.districts DROP d7_package_id;
ALTER TABLE fuse_laravel_test.district_user DROP d7_district_id;
ALTER TABLE fuse_laravel_test.district_user DROP d7_uid;
ALTER TABLE fuse_laravel_test.schools DROP d7_id;
ALTER TABLE fuse_laravel_test.schools DROP d7_district_id;
ALTER TABLE fuse_laravel_test.schools DROP d7_package_id;
ALTER TABLE fuse_laravel_test.school_user DROP d7_school_id;
ALTER TABLE fuse_laravel_test.school_user DROP d7_uid;
ALTER TABLE fuse_laravel_test.studios DROP d7_id;
ALTER TABLE fuse_laravel_test.studios DROP d7_school_id;
ALTER TABLE fuse_laravel_test.studios DROP d7_package_id;
ALTER TABLE fuse_laravel_test.studio_user DROP d7_studio_id;
ALTER TABLE fuse_laravel_test.studio_user DROP d7_uid;
ALTER TABLE fuse_laravel_test.ideas DROP d7_id;
ALTER TABLE fuse_laravel_test.idea_inspirations DROP d7_idea_id;
ALTER TABLE fuse_laravel_test.idea_inspirations DROP d7_challenge_version_id;
ALTER TABLE fuse_laravel_test.comments DROP d7_artifact_id;
ALTER TABLE fuse_laravel_test.comments DROP d7_uid;
ALTER TABLE fuse_laravel_test.comment_seen DROP d7_comment_id;
ALTER TABLE fuse_laravel_test.comment_seen DROP d7_uid;
ALTER TABLE fuse_laravel_test.partners DROP d7_id;
ALTER TABLE fuse_laravel_test.schools DROP d7_partner_id;