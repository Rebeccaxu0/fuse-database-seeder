-- Run search and replace on source database `fuse` if necessary.
-- Run search and replace on target database `fuse_laravel_test` if necessary.
-- Add temp D7 migration columns.
ALTER TABLE `fuse_laravel_test`.users ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX users_d7_id_IDX USING BTREE ON `fuse_laravel_test`.users (d7_id);
-- ALTER TABLE `fuse_laravel_test`.users ADD d7_current_studio BIGINT UNSIGNED DEFAULT 1;
-- CREATE INDEX users_d7_current_studio_IDX USING BTREE ON `fuse_laravel_test`.users (d7_current_studio);
ALTER TABLE `fuse_laravel_test`.challenge_categories ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_categories_d7_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_categories (d7_id);
ALTER TABLE `fuse_laravel_test`.challenges ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenges_d7_id_IDX USING BTREE ON `fuse_laravel_test`.challenges (d7_id);
ALTER TABLE `fuse_laravel_test`.challenge_versions ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_versions_d7_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_versions (d7_id);
ALTER TABLE `fuse_laravel_test`.challenge_versions ADD d7_challenge_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_versions_d7_challenge_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_versions (d7_challenge_id);
ALTER TABLE `fuse_laravel_test`.challenge_versions ADD d7_challenge_category_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_versions_d7_challenge_category_id_idX USING BTREE ON `fuse_laravel_test`.challenge_versions (d7_challenge_category_id);
ALTER TABLE `fuse_laravel_test`.challenge_versions ADD d7_prereq_challenge_id BIGINT UNSIGNED NULL;
CREATE INDEX challenge_versions_d7_prereq_challenge_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_versions (d7_prereq_challenge_id);
ALTER TABLE `fuse_laravel_test`.levels ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX levels_d7_id_IDX USING BTREE ON `fuse_laravel_test`.levels (d7_id);
ALTER TABLE `fuse_laravel_test`.levels ADD d7_challenge_version_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX levels_d7_challenge_version_id_IDX USING BTREE ON `fuse_laravel_test`.levels (d7_challenge_version_id);
ALTER TABLE `fuse_laravel_test`.levels ADD d7_prereq_level_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX levels_d7_prereq_level_id_IDX USING BTREE ON `fuse_laravel_test`.levels (d7_prereq_level_id);
ALTER TABLE `fuse_laravel_test`.l_t_i_platforms ADD d7_id BIGINT UNSIGNED DEFAULT 1;
ALTER TABLE `fuse_laravel_test`.packages ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX packages_d7_id_IDX USING BTREE ON `fuse_laravel_test`.packages (d7_id);
ALTER TABLE `fuse_laravel_test`.challenge_package ADD d7_challenge_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_package_d7_challenge_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_package (d7_challenge_id);
ALTER TABLE `fuse_laravel_test`.challenge_package ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX challenge_package_d7_package_id_IDX USING BTREE ON `fuse_laravel_test`.challenge_package (d7_package_id);
ALTER TABLE `fuse_laravel_test`.roles ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX roles_d7_id_IDX USING BTREE ON `fuse_laravel_test`.roles (d7_id);
ALTER TABLE `fuse_laravel_test`.role_user ADD d7_rid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX role_user_d7_rid_IDX USING BTREE ON `fuse_laravel_test`.role_user (d7_rid);
ALTER TABLE `fuse_laravel_test`.role_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX role_user_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.role_user (d7_uid);
ALTER TABLE `fuse_laravel_test`.artifacts ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX artifacts_d7_id_IDX USING BTREE ON `fuse_laravel_test`.artifacts (d7_id);
ALTER TABLE `fuse_laravel_test`.districts ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX districts_d7_id_IDX USING BTREE ON `fuse_laravel_test`.districts (d7_id);
ALTER TABLE `fuse_laravel_test`.district_user ADD d7_district_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX district_user_d7_district_id_IDX USING BTREE ON `fuse_laravel_test`.district_user (d7_district_id);
ALTER TABLE `fuse_laravel_test`.district_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX district_user_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.district_user (d7_uid);
ALTER TABLE `fuse_laravel_test`.schools ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX schools_d7_id_IDX USING BTREE ON `fuse_laravel_test`.schools (d7_id);
ALTER TABLE `fuse_laravel_test`.school_user ADD d7_school_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX school_user_d7_school_id_IDX USING BTREE ON `fuse_laravel_test`.school_user (d7_school_id);
ALTER TABLE `fuse_laravel_test`.school_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX school_user_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.school_user (d7_uid);
ALTER TABLE `fuse_laravel_test`.studios MODIFY COLUMN join_code varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE `fuse_laravel_test`.studios ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX studios_d7_id_IDX USING BTREE ON `fuse_laravel_test`.studios (d7_id);
ALTER TABLE `fuse_laravel_test`.studios ADD d7_school_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX studios_d7_school_id_IDX USING BTREE ON `fuse_laravel_test`.studios (d7_school_id);
ALTER TABLE `fuse_laravel_test`.studios ADD d7_package_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX studios_d7_package_id_IDX USING BTREE ON `fuse_laravel_test`.studios (d7_package_id);
ALTER TABLE `fuse_laravel_test`.studio_user ADD d7_studio_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX studio_user_d7_studio_id_IDX USING BTREE ON `fuse_laravel_test`.studio_user (d7_studio_id);
ALTER TABLE `fuse_laravel_test`.studio_user ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX studio_user_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.studio_user (d7_uid);
ALTER TABLE `fuse_laravel_test`.ideas ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX ideas_d7_id_IDX USING BTREE ON `fuse_laravel_test`.ideas (d7_id);
ALTER TABLE `fuse_laravel_test`.comments ADD d7_artifact_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX comments_d7_artifact_id_IDX USING BTREE ON `fuse_laravel_test`.comments (d7_artifact_id);
ALTER TABLE `fuse_laravel_test`.comments ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX comments_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.comments (d7_uid);
ALTER TABLE `fuse_laravel_test`.comment_seen ADD d7_comment_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX comment_seen_d7_comment_id_IDX USING BTREE ON `fuse_laravel_test`.comment_seen (d7_comment_id);
ALTER TABLE `fuse_laravel_test`.comment_seen ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX comment_seen_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.comment_seen (d7_uid);
ALTER TABLE `fuse_laravel_test`.partners ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX partners_d7_id_IDX USING BTREE ON `fuse_laravel_test`.partners (d7_id);
ALTER TABLE `fuse_laravel_test`.schools ADD d7_partner_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX schools_d7_partner_id_IDX USING BTREE ON `fuse_laravel_test`.schools (d7_partner_id);
ALTER TABLE `fuse_laravel_test`.grade_levels ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX grade_levels_d7_id_IDX USING BTREE ON `fuse_laravel_test`.grade_levels (d7_id);
ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN affiliated_studios varchar(2047) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN studio_id bigint(20) unsigned NULL;
ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN studio_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_id_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_id);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_uid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_uid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_uid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_lid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_lid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_lid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_studio_nid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_studio_nid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_studio_nid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_artifact_nid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_artifact_nid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_artifact_nid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_trigger_aid BIGINT UNSIGNED DEFAULT NULL;
CREATE INDEX activity_log_d7_trigger_aid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_trigger_aid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_school_nid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_school_nid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_school_nid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_district_nid BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_district_nid_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_district_nid);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_trigger_id BIGINT UNSIGNED DEFAULT 1;
CREATE INDEX activity_log_d7_trigger_id_IDX USING BTREE ON `fuse_laravel_test`.activity_log (d7_trigger_id);
ALTER TABLE `fuse_laravel_test`.activity_log ADD d7_afilliated_studios VARCHAR(2048) DEFAULT NULL NULL;
ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN user_id bigint(20) unsigned NULL;

-- Insert Challenge Taxonomy Terms
INSERT INTO `fuse_laravel_test`.challenges (name, description, d7_id)
SELECT name, description, tid as d7_id from `fuse`.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT `fuse`.taxonomy_vocabulary.vid
FROM `fuse`.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenges')
)
ORDER BY name;

-- Insert Challenge Category Taxonomy Terms
INSERT INTO `fuse_laravel_test`.challenge_categories (name, description, d7_id)
SELECT name, description, tid as d7_id from `fuse`.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT `fuse`.taxonomy_vocabulary.vid
FROM `fuse`.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenge_categories')
)
ORDER BY name;

-- Insert Grade Level Taxonomy Terms
INSERT INTO `fuse_laravel_test`.grade_levels (name, description, d7_id)
SELECT name, description, tid as d7_id from `fuse`.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT `fuse`.taxonomy_vocabulary.vid
FROM `fuse`.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'grade_level')
)
ORDER BY name;

-- Insert Partner Taxonomy Terms
INSERT INTO `fuse_laravel_test`.partners (name, description, d7_id)
SELECT name, description, tid as d7_id from `fuse`.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT `fuse`.taxonomy_vocabulary.vid
FROM `fuse`.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'partnership')
)
ORDER BY name;

-- Insert LTI Platforms
INSERT INTO `fuse_laravel_test`.l_t_i_platforms (
  domain, client_id,
  auth_login_url, auth_token_url,
  key_set_url, private_key,
  deployment_json, lineitems, scope,
  api_token, api_secret, api_endpoint,
  d7_id
)
SELECT
  domain, client_id,
  auth_login_url, auth_token_url,
  key_set_url, private_key,
  deployment, lineitems, scope,
  api_token, api_secret, api_endpoint,
  id
FROM `fuse`.l3_platform;

-- Insert Packages
INSERT INTO `fuse_laravel_test`.packages (created_at, updated_at, name, description, student_activity_tab_access, d7_id)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), n.title, fdb.body_value, fdfsat.field_student_activity_tab_value, n.nid as d7_id
FROM `fuse`.node AS n
LEFT JOIN `fuse`.field_data_body AS fdb ON
  (fdb.entity_type = 'node'
  AND fdb.bundle = 'package'
  AND fdb.entity_id = n.nid)
LEFT JOIN `fuse`.field_data_field_student_activity_tab AS fdfsat ON
  (fdfsat.entity_type = 'node'
  AND fdfsat.bundle = 'package'
  AND fdfsat.entity_id = n.nid)
WHERE n.type = 'package';

-- Package Challenges
INSERT INTO `fuse_laravel_test`.challenge_package (challenge_id, package_id, d7_challenge_id, d7_package_id)
SELECT 1, 1, field_package_challenges_term_target_id, entity_id
FROM `fuse`.field_data_field_package_challenges_term
WHERE entity_type = 'node' AND bundle = 'package';

-- Update foreign keys
UPDATE `fuse_laravel_test`.challenge_package pivot
LEFT JOIN `fuse_laravel_test`.challenges c ON pivot.d7_challenge_id = c.d7_id
LEFT JOIN `fuse_laravel_test`.packages p ON pivot.d7_package_id = p.d7_id
SET pivot.challenge_id = c.id, pivot.package_id = p.id;

-- All translation fields need to be added one by one or `JSON_OBJECTTAGG`
-- will insert duplicate entries
-- Insert Challenge Versions
INSERT INTO `fuse_laravel_test`.challenge_versions (
  name,
  challenge_id, challenge_category_id,
  slug,
  info_article_url,
  d7_id, d7_challenge_id, d7_challenge_category_id, d7_prereq_challenge_id,
  created_at, updated_at
)
SELECT
  JSON_OBJECT("en", n.title), 1, 1,
  CONCAT(n.title, n.nid),
  fdfiu.field_info_url_url,
  n.nid, challenge_ttd.tid, challenge_category_ttd.tid, fdfpc.field_prerequisite_challenges_nid,
  FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed)
FROM `fuse`.node AS n
LEFT JOIN `fuse`.field_data_field_version_of AS fdfvo ON
  (fdfvo.entity_type = 'node'
  AND fdfvo.bundle = 'challenge'
  AND fdfvo.entity_id = n.nid)
LEFT JOIN `fuse`.taxonomy_term_data challenge_ttd
  ON challenge_ttd.tid = fdfvo.field_version_of_target_id
LEFT JOIN `fuse`.field_data_field_challenge_category AS fdfcc ON
  (fdfcc.entity_type = 'node'
  AND fdfcc.bundle = 'challenge'
  AND fdfcc.entity_id = n.nid)
LEFT JOIN `fuse`.taxonomy_term_data challenge_category_ttd
  ON challenge_category_ttd.tid = fdfcc.field_challenge_category_tid
LEFT JOIN `fuse`.field_data_field_prerequisite_challenges AS fdfpc ON
  (fdfpc.entity_type = 'node'
  AND fdfpc.bundle = 'challenge'
  AND fdfpc.entity_id = n.nid)
LEFT JOIN `fuse`.field_data_field_info_url AS fdfiu ON
  (fdfiu.entity_type = 'node'
  AND fdfiu.bundle = 'challenge'
  AND fdfiu.entity_id = n.nid)
WHERE n.type = 'challenge'
GROUP BY n.nid
ORDER BY n.title ASC;

-- Add translation fields one by one
-- Summary
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, body_value) as summary
  FROM `fuse`.field_data_body
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as s
ON cv.d7_id = s.entity_id
SET cv.summary = s.summary;

-- Blurb
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, field_blurb_value) as blurb
  FROM `fuse`.field_data_field_blurb
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as b
ON cv.d7_id = b.entity_id
SET cv.blurb = b.blurb;

-- Stuff You Need
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, field_materials_needed_value) as stuff_you_need
  FROM `fuse`.field_data_field_materials_needed
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as syn
ON cv.d7_id = syn.entity_id
SET cv.stuff_you_need = syn.stuff_you_need;

-- Chromebook Info
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, field_chromebook_info_value) as chromebook_info
  FROM `fuse`.field_data_field_chromebook_info
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as ci
ON cv.d7_id = ci.entity_id
SET cv.chromebook_info = ci.chromebook_info;

-- Facilitator Notes
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, field_facilitator_notes_value) as facilitator_notes
  FROM `fuse`.field_data_field_facilitator_notes
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as fn
ON cv.d7_id = fn.entity_id
SET cv.facilitator_notes = fn.facilitator_notes;

-- Gallery Version Description (short)
UPDATE `fuse_laravel_test`.challenge_versions cv
JOIN (
  SELECT entity_id, JSON_OBJECTAGG(`language`, field_facilitator_notes_value) as facilitator_notes
  FROM `fuse`.field_data_field_facilitator_notes
  WHERE entity_type = 'node' AND bundle = 'challenge'
  GROUP BY entity_id) as fn
ON cv.d7_id = fn.entity_id
SET cv.facilitator_notes = fn.facilitator_notes;

-- Update foreign keys
-- ASSUMPTION: 'legacy' challenge id is 1, and 'legacy' challenge category id is 7.
UPDATE `fuse_laravel_test`.challenge_versions cv
LEFT JOIN `fuse_laravel_test`.challenges c ON cv.d7_challenge_id = c.d7_id
LEFT JOIN `fuse_laravel_test`.challenge_categories cc ON cv.d7_challenge_category_id = cc.d7_id
LEFT JOIN `fuse_laravel_test`.challenge_versions prereq ON cv.d7_prereq_challenge_id = prereq.d7_id
SET cv.challenge_id = COALESCE(c.id, 1), cv.challenge_category_id = COALESCE(cc.id, 7), cv.prerequisite_challenge_version_id = prereq.id;

-- Insert Levels
INSERT INTO `fuse_laravel_test`.levels
(created_at, updated_at, challenge_version_id, d7_id, d7_challenge_version_id, d7_prereq_level_id)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), 1, n.nid as d7_id, fdfc.field_challenge_nid, fdfp.field_prerequisites_nid
FROM `fuse`.node AS n
RIGHT OUTER JOIN `fuse`.field_data_field_challenge AS fdfc ON
  (fdfc.entity_type = 'node'
  AND fdfc.bundle = 'level'
  AND fdfc.entity_id = n.nid
  AND fdfc.field_challenge_nid IN (SELECT cv.d7_id FROM `fuse_laravel_test`.challenge_versions cv))
LEFT JOIN `fuse`.field_data_field_prerequisites AS fdfp ON
  (fdfp.entity_type = 'node'
  AND fdfp.bundle = 'level'
  AND fdfp.entity_id = n.nid)
WHERE
  n.type = 'level'
  AND !ISNULL(fdfc.field_challenge_nid)
  AND n.nid IN (SELECT fdfcl.field_child_levels_nid FROM `fuse`.field_data_field_child_levels fdfcl)
ORDER BY fdfc.field_challenge_nid ASC;

-- Update foreign keys
UPDATE `fuse_laravel_test`.levels levels
LEFT JOIN `fuse_laravel_test`.challenge_versions cv ON levels.d7_challenge_version_id = cv.d7_id
SET levels.challenge_version_id = cv.id
WHERE !ISNULL(cv.id);

-- Prerequisite level
UPDATE `fuse_laravel_test`.levels levels
LEFT JOIN `fuse_laravel_test`.levels prereq ON levels.d7_prereq_level_id = prereq.d7_id
SET levels.prerequisite_level = prereq.id
WHERE !ISNULL(prereq.id);

-- Set explicit level numbers
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 1 WHERE ISNULL(levels.prerequisite_level);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 2
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 1);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 3
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 2);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 4
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 3);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 5
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 4);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 6
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 5);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 7
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 6);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 8
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 7);
UPDATE `fuse_laravel_test`.levels levels SET levels.level_number = 9
WHERE levels.prerequisite_level IN (SELECT l.id FROM `fuse_laravel_test`.levels l WHERE l.level_number = 8);

-- Studios/Schools/Districts

-- Districts
INSERT INTO `fuse_laravel_test`.districts (
  created_at, updated_at, name, license_status,
  package_id,
  salesforce_acct_id, d7_id
)
SELECT FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed), n.title, n.status,
  packages.id,
  IF(fdfsai.field_salesforce_acct_id_value = '', NULL, fdfsai.field_salesforce_acct_id_value) as sfid, n.nid
FROM `fuse`.node AS n
LEFT JOIN `fuse`.field_data_field_organization_type AS fdfot ON
  (fdfot.entity_type = 'node'
  AND fdfot.bundle = 'organization'
  AND fdfot.entity_id = n.nid)
LEFT JOIN `fuse`.field_data_field_package AS fdfp ON
  (fdfp.entity_type = 'node'
  AND fdfp.bundle = 'organization'
  AND fdfp.entity_id = n.nid)
LEFT JOIN `fuse_laravel_test`.packages packages ON
  (packages.d7_id = fdfp.field_package_target_id)
LEFT JOIN `fuse`.field_data_field_salesforce_acct_id AS fdfsai ON
  (fdfsai.entity_type = 'node'
  AND fdfsai.bundle = 'organization'
  AND fdfsai.entity_id = n.nid)
WHERE n.type = 'organization' AND fdfot.field_organization_type_tid = 161;

-- Schools
-- WARNING: Make sure all Salesforce IDs are unique before importing.
-- SELECT fdfsai.field_salesforce_acct_id_value, COUNT(fdfsai.field_salesforce_acct_id_value)
-- FROM `fuse`.field_data_field_salesforce_acct_id fdfsai
-- GROUP BY fdfsai.field_salesforce_acct_id_value
-- HAVING COUNT(field_salesforce_acct_id_value) > 1;
INSERT INTO `fuse_laravel_test`.schools (
  created_at, updated_at, name, status, district_id, package_id, partner_id,
  salesforce_acct_id, d7_id
)
SELECT FROM_UNIXTIME(n.created) as created, FROM_UNIXTIME(n.changed) as changed,
  n.title, n.status, districts.id as district, packages.id, partners.id,
  IF(fdfsai.field_salesforce_acct_id_value = '', NULL, fdfsai.field_salesforce_acct_id_value) as sfid, n.nid
FROM `fuse`.node AS n
LEFT JOIN `fuse`.field_data_field_organization_type AS fdfot ON
  (fdfot.entity_type = 'node'
  AND fdfot.bundle = 'organization'
  AND fdfot.entity_id = n.nid)
LEFT JOIN `fuse`.field_data_field_package AS fdfp ON
  (fdfp.entity_type = 'node'
  AND fdfp.bundle = 'organization'
  AND fdfp.entity_id = n.nid)
LEFT JOIN `fuse_laravel_test`.packages packages ON
  (packages.d7_id = fdfp.field_package_target_id)
LEFT JOIN `fuse`.field_data_field_partnership AS d_partnership ON
  (d_partnership.entity_type = 'node'
  AND d_partnership.bundle = 'organization'
  AND d_partnership.entity_id = n.nid)
LEFT JOIN `fuse_laravel_test`.partners partners ON
  (partners.d7_id = d_partnership.field_partnership_tid)
LEFT JOIN `fuse`.og_membership om ON
  (om.entity_type = 'node'
  AND om.etid = n.nid)
LEFT JOIN `fuse_laravel_test`.districts districts ON
  (districts.d7_id = om.gid)
LEFT JOIN `fuse`.field_data_field_salesforce_acct_id AS fdfsai ON
  (fdfsai.entity_type = 'node'
  AND fdfsai.bundle = 'organization'
  AND fdfsai.entity_id = n.nid)
WHERE n.type = 'organization' AND fdfot.field_organization_type_tid = 166;

-- Grade Levels
INSERT INTO `fuse_laravel_test`.grade_level_school (school_id, grade_level_id)
SELECT school.id, grade_level.id
FROM `fuse`.field_data_field_grade_level_term fdfglt
LEFT JOIN `fuse_laravel_test`.grade_levels grade_level ON grade_level.d7_id = fdfglt.field_grade_level_term_tid
LEFT JOIN `fuse_laravel_test`.schools school ON school.d7_id = fdfglt.entity_id
WHERE fdfglt.entity_type = 'node' AND fdfglt.bundle = 'organization';

-- Studios
-- TODO: Ensure all studios have a join code. Exclude Alumni.
INSERT INTO `fuse_laravel_test`.studios (created_at, updated_at, name, status, school_id, package_id, join_code, dashboard_message, d7_id)
SELECT FROM_UNIXTIME(n.created) as created, FROM_UNIXTIME(n.changed) as changed,
  n.title, n.status, schools.id, packages.id as package_id, fdfsc.field_studio_code_studio_code as join_code, fsm.message as dashboard_message, n.nid
FROM `fuse`.node AS n
LEFT JOIN `fuse`.field_data_field_package AS fdfp ON
  (fdfp.entity_type = 'node'
  AND fdfp.bundle = 'space'
  AND fdfp.entity_id = n.nid)
LEFT JOIN `fuse_laravel_test`.packages packages ON
  (packages.d7_id = fdfp.field_package_target_id)
LEFT JOIN `fuse`.og_membership om ON
  (om.entity_type = 'node'
  AND om.etid = n.nid)
LEFT JOIN `fuse_laravel_test`.schools schools ON
  (schools.d7_id = om.gid)
LEFT JOIN `fuse`.field_data_field_salesforce_acct_id AS fdfsai ON
  (fdfsai.entity_type = 'node'
  AND fdfsai.bundle = 'space'
  AND fdfsai.entity_id = n.nid)
LEFT JOIN `fuse`.field_data_field_studio_code AS fdfsc ON
  (fdfsc.entity_type = 'node'
  AND fdfsc.bundle = 'space'
  AND fdfsc.entity_id = n.nid)
LEFT JOIN `fuse`.fuse_studio_message AS fsm ON
  (fsm.studio_nid = n.nid)
WHERE n.type = 'space' AND n.nid <> 934966;

-- LTI Platform associations
INSERT INTO `fuse_laravel_test`.l_t_i_platformable (l_t_i_platform_id, l_t_i_platformable_id, l_t_i_platformable_type)
SELECT lti_platforms.id, studios.id, 'studio'
FROM `fuse`.field_data_field_l3_platforms fdflp
LEFT JOIN `fuse_laravel_test`.l_t_i_platforms as lti_platforms ON
  lti_platforms.d7_id = fdflp.field_l3_platforms_target_id
LEFT JOIN `fuse_laravel_test`.studios as studios ON
  studios.d7_id = fdflp.entity_id
WHERE fdflp.entity_type = 'node' AND fdflp.bundle = 'space';

INSERT INTO `fuse_laravel_test`.l_t_i_platformable (l_t_i_platform_id, l_t_i_platformable_id, l_t_i_platformable_type)
SELECT lti_platforms.id, schools.id, 'school'
FROM `fuse`.field_data_field_l3_platforms fdflp
LEFT JOIN `fuse_laravel_test`.l_t_i_platforms as lti_platforms ON
  lti_platforms.d7_id = fdflp.field_l3_platforms_target_id
LEFT JOIN `fuse_laravel_test`.schools as schools ON
  schools.d7_id = fdflp.entity_id
RIGHT JOIN `fuse`.field_data_field_organization_type fdfot ON
  fdfot.entity_id = fdflp.entity_id AND fdfot.field_organization_type_tid = 166
WHERE fdflp.entity_type = 'node' AND fdflp.bundle = 'organization';

INSERT INTO `fuse_laravel_test`.l_t_i_platformable (l_t_i_platform_id, l_t_i_platformable_id, l_t_i_platformable_type)
SELECT lti_platforms.id, districts.id, 'district'
FROM `fuse`.field_data_field_l3_platforms fdflp
LEFT JOIN `fuse_laravel_test`.l_t_i_platforms as lti_platforms ON
  lti_platforms.d7_id = fdflp.field_l3_platforms_target_id
LEFT JOIN `fuse_laravel_test`.districts as districts ON
  districts.d7_id = fdflp.entity_id
RIGHT JOIN `fuse`.field_data_field_organization_type fdfot ON
  fdfot.entity_id = fdflp.entity_id AND fdfot.field_organization_type_tid = 161
WHERE fdflp.entity_type = 'node' AND fdflp.bundle = 'organization';

-- Users

-- Clean up data import source.
-- First, blank emails should be NULL.
UPDATE `fuse`.users SET mail = NULL WHERE mail = '';

-- Next, if an account is linked to Google SSO, we regard that account as the
-- true owner of that email address. Remove that email address from all other
-- accounts (duplicates).
UPDATE `fuse`.users u SET u.mail = NULL
WHERE u.uid IN (
  -- Remove entries that have the linked Google SSO account.
  SELECT u.uid FROM `fuse`.users u LEFT JOIN `fuse`.fuse_sso sso ON sso.uid = u.uid
  WHERE ISNULL(sso.google_id)
  AND u.mail IN (
    -- Narrow duplicates to only those where at least one has a linked Google SSO account.
    SELECT u.mail FROM `fuse`.users u LEFT JOIN `fuse`.fuse_sso sso ON sso.uid = u.uid
    WHERE NOT ISNULL(sso.google_id)
    AND u.mail IN (
      -- Get list of duplicate email addresses.
      SELECT mail FROM `fuse`.users group by mail having count(mail) > 1
    )
  )
);

-- Remove known fake addresses.
UPDATE `fuse`.users u SET u.mail = NULL
WHERE u.mail IN (
  '1234567@brevardschools.org', '12345@district65.net', 'makers@madatech.org.il',
  'stonestudent@gmail.com', 'sphillips@ssttx.org', 'anne@fusestudio.net',
  'cbeals@windwardschool.org', 'siltamaen.ala.aste@gmail.com', 'skoglundc@district65.net',
  'lberghoff@dist113.org', 'lanamyers@sd54.org', 'christinawhitten@sd54.org',
  'brigitte.williams@cslocal.org'
);

-- Remove email address from accounts that are not the most recently logged in.
UPDATE `fuse`.users SET mail = NULL
WHERE mail IN (
  -- Get dupes.
  SELECT mail FROM `fuse`.users
  WHERE NOT ISNULL(mail)
  group by mail having count(mail) > 1
)
AND uid NOT IN (
  -- Get UID of most recently logged in dupe.
  Select u.uid FROM `fuse`.users u
  INNER JOIN (
    SELECT mail, MAX(login) as login
    FROM `fuse`.users
    WHERE NOT ISNULL(mail)
    group by mail having count(mail) > 1
  ) login
  ON u.mail = login.mail AND u.login = login.login
);

-- The Strange case of `kyraclark888@gmail.com`
UPDATE `fuse`.users SET mail = NULL WHERE uid = 207096;

INSERT INTO `fuse_laravel_test`.users
  (name, full_name, email, password,
  created_at, status, timezone, seen_idea_trailer,
  login,
  last_access,
  language, d7_id,
  reporting_id,
  avatar_config,
  gender, ethnicity,
  birthday,
  guardian, email_of_guardian, irb_consent, photo_consent,
  guardian_irb_consent, guardian_photo_consent,
  consent_email_last_sent, allow_survey,
  csv_header, csv_values,
  active_studio, current_level)
SELECT
  u.name, fullname.field_full_name_value as fullname, u.mail, u.pass,
  FROM_UNIXTIME(u.created) as created, u.status,
  IF (NOT ISNULL(u.timezone) AND u.timezone != '', u.timezone, 'America/Chicago') as timezone,
  IF (
    ISNULL(d_seen_idea_trailer.field_seen_idea_trailer_value),
    0, d_seen_idea_trailer.field_seen_idea_trailer_value
  ) as seen_trailer,
  IF (NOT ISNULL(u.login) AND u.login != 0, FROM_UNIXTIME(u.login), NULL) as login,
  IF (NOT ISNULL(u.access) AND u.access != 0, FROM_UNIXTIME(u.access), NULL) as access,
  IF (NOT ISNULL(u.language) AND u.language != '', u.language, 'en') as language, u.uid,
  IF (
    NOT ISNULL(d_reporting_id.field_reporting_id_value)
    AND d_reporting_id.field_reporting_id_value != '0'
    AND d_reporting_id.field_reporting_id_value != '',
    d_reporting_id.field_reporting_id_value, NULL
  ) as reporting_id,
  d_avatar_configuration.field_avatar_configuration_value as avatar_config,
  gender.field_gender_value as gender, ethnicity.field_ethnicity_value as ethnicity,
  DATE(birthday.field_birthday_value) as birthday,
  parent_guardian.field_parent_guardian_value as guardian, parent_guardians_email.field_parent_guardians_email_email as guardian_email,
  personal_irb_consent.field_personal_irb_consent_value as irb_consent,
  personal_photo_consent.field_personal_photo_consent_value as photo_consent,
  p_g_irb_consent.field_p_g_irb_consent_value as guardian_irb_consent,
  p_g_photo_consent.field_p_g_photo_consent_value as guardian_photo_consent,
  DATE(consent_email_last_sent.field_consent_email_last_sent_value) as consent_email_last_sent,
  allow_survey.field_allow_survey_value as allow_survey,
  csv_header.field_csv_header_value as csv_header, csv_values.field_csv_values_value as csv,
  studio.id as studio, COALESCE (current_level.id, last_level.id) as current_level
FROM `fuse`.users u
LEFT JOIN `fuse`.profile profile ON profile.uid = u.uid AND profile.type = 'student'
LEFT JOIN `fuse`.field_data_field_full_name fullname
  ON fullname.entity_id = profile.uid AND fullname.entity_type = 'user'
  AND fullname.bundle = 'user' AND fullname.deleted = 0
LEFT JOIN `fuse`.field_data_field_gender gender
  ON gender.entity_id = profile.pid AND gender.entity_type = 'profile2'
  AND gender.bundle = 'student' AND gender.deleted = 0
LEFT JOIN `fuse`.field_data_field_ethnicity ethnicity
  ON ethnicity.entity_id = profile.pid AND ethnicity.entity_type = 'profile2'
  AND ethnicity.bundle = 'student' AND ethnicity.deleted = 0
LEFT JOIN `fuse`.field_data_field_birthday birthday
  ON birthday.entity_id = profile.pid AND birthday.entity_type = 'profile2'
  AND birthday.bundle = 'student' AND birthday.deleted = 0
LEFT JOIN `fuse`.field_data_field_csv_header csv_header
  ON csv_header.entity_id = profile.pid AND csv_header.entity_type = 'profile2'
  AND csv_header.bundle = 'student' AND csv_header.deleted = 0
LEFT JOIN `fuse`.field_data_field_csv_values csv_values
  ON csv_values.entity_id = profile.pid AND csv_values.entity_type = 'profile2'
  AND csv_values.bundle = 'student' AND csv_values.deleted = 0
LEFT JOIN `fuse`.field_data_field_parent_guardian parent_guardian
  ON parent_guardian.entity_id = profile.pid AND parent_guardian.entity_type = 'profile2'
  AND parent_guardian.bundle = 'student' AND parent_guardian.deleted = 0
LEFT JOIN `fuse`.field_data_field_parent_guardians_email parent_guardians_email
  ON parent_guardians_email.entity_id = profile.pid AND parent_guardians_email.entity_type = 'profile2'
  AND parent_guardians_email.bundle = 'student' AND parent_guardians_email.deleted = 0
LEFT JOIN `fuse`.field_data_field_personal_irb_consent personal_irb_consent
  ON personal_irb_consent.entity_id = profile.pid AND personal_irb_consent.entity_type = 'profile2'
  AND personal_irb_consent.bundle = 'student' AND personal_irb_consent.deleted = 0
LEFT JOIN `fuse`.field_data_field_personal_photo_consent personal_photo_consent
  ON personal_photo_consent.entity_id = profile.pid AND personal_photo_consent.entity_type = 'profile2'
  AND personal_photo_consent.bundle = 'student' AND personal_photo_consent.deleted = 0
LEFT JOIN `fuse`.field_data_field_p_g_irb_consent p_g_irb_consent
  ON p_g_irb_consent.entity_id = profile.pid AND p_g_irb_consent.entity_type = 'profile2'
  AND p_g_irb_consent.bundle = 'student' AND p_g_irb_consent.deleted = 0
LEFT JOIN `fuse`.field_data_field_p_g_photo_consent p_g_photo_consent
  ON p_g_photo_consent.entity_id = profile.pid AND p_g_photo_consent.entity_type = 'profile2'
  AND p_g_photo_consent.bundle = 'student' AND p_g_photo_consent.deleted = 0
LEFT JOIN `fuse`.field_data_field_consent_email_last_sent consent_email_last_sent
  ON consent_email_last_sent.entity_id = profile.pid AND consent_email_last_sent.entity_type = 'profile2'
  AND consent_email_last_sent.bundle = 'student' AND consent_email_last_sent.deleted = 0
LEFT JOIN `fuse`.field_data_field_opt_out_date opt_out_date
  ON opt_out_date.entity_id = profile.pid AND opt_out_date.entity_type = 'profile2'
  AND opt_out_date.bundle = 'student' AND opt_out_date.deleted = 0
LEFT JOIN `fuse`.field_data_field_allow_survey allow_survey
  ON allow_survey.entity_id = profile.pid AND allow_survey.entity_type = 'profile2'
  AND allow_survey.bundle = 'student' AND allow_survey.deleted = 0
LEFT JOIN `fuse`.field_data_field_reporting_id d_reporting_id
  ON d_reporting_id.entity_id = u.uid AND d_reporting_id.entity_type = 'user'
  AND d_reporting_id.bundle = 'user'  AND d_reporting_id.deleted = 0
LEFT JOIN `fuse`.field_data_field_avatar_configuration d_avatar_configuration
  ON d_avatar_configuration.entity_id = u.uid AND d_avatar_configuration.entity_type = 'user'
  AND d_avatar_configuration.bundle = 'user' AND d_avatar_configuration.deleted = 0
LEFT JOIN `fuse`.field_data_field_seen_idea_trailer d_seen_idea_trailer
  ON d_seen_idea_trailer.entity_id = u.uid AND d_seen_idea_trailer.entity_type = 'user'
  AND d_seen_idea_trailer.bundle = 'user' AND d_seen_idea_trailer.deleted = 0
LEFT JOIN `fuse`.field_data_field_current_location d_studio
  ON d_studio.entity_id = u.uid AND d_studio.entity_type = 'user'
  AND d_studio.bundle = 'user' AND d_studio.deleted = 0
LEFT JOIN `fuse_laravel_test`.studios studio
  ON studio.d7_id = d_studio.field_current_location_nid
LEFT JOIN `fuse`.field_data_field_current_level d_current_level
  ON d_current_level.entity_id = u.uid AND d_current_level.entity_type = 'user'
  AND d_current_level.bundle = 'user' AND d_current_level.deleted = 0
LEFT JOIN `fuse_laravel_test`.levels current_level
  ON current_level.d7_id = d_current_level.field_current_level_nid
LEFT JOIN `fuse`.field_data_field_last_level d_last_level
  ON d_last_level.entity_id = u.uid AND d_last_level.entity_type = 'user'
  AND d_last_level.bundle = 'user' AND d_last_level.deleted = 0
LEFT JOIN `fuse_laravel_test`.levels last_level
  ON last_level.d7_id = d_last_level.field_last_level_nid
WHERE u.uid <> 0
-- Do not import 'oggo', uid = 96176
AND u.uid != 96176
ORDER BY u.uid;

-- Remove bad ethnicity data.
UPDATE `fuse_laravel_test`.users SET ethnicity = NULL
WHERE
  ethnicity IS NOT NULL
  AND ethnicity NOT IN (
    'rather_not_say','caucasian','african_american','hispanic_latino','asian',
    'multiracial','international','indigenous_american','middle_eastern',
    'pacific_islander');

-- Studio Membership (Students)
INSERT INTO `fuse_laravel_test`.studio_user (user_id, studio_id)
SELECT u.id, studios.id
FROM `fuse_laravel_test`.users u
LEFT JOIN `fuse`.og_membership om ON
  (om.entity_type = 'user'
  AND om.etid = u.d7_id)
LEFT JOIN `fuse_laravel_test`.studios ON studios.d7_id = om.gid
WHERE NOT ISNULL(studios.id);

-- School Membership (Facilitators)
INSERT INTO `fuse_laravel_test`.school_user (user_id, school_id)
SELECT u.id, schools.id
FROM `fuse_laravel_test`.users u
LEFT JOIN `fuse`.og_membership om ON
  (om.entity_type = 'user'
  AND om.etid = u.d7_id)
LEFT JOIN `fuse_laravel_test`.schools ON schools.d7_id = om.gid
WHERE NOT ISNULL(schools.id);

-- District Membership (Super Facilitators)
INSERT INTO `fuse_laravel_test`.district_user (user_id, district_id)
SELECT u.id, districts.id
FROM `fuse_laravel_test`.users u
LEFT JOIN `fuse`.og_membership om ON
  (om.entity_type = 'user'
  AND om.etid = u.d7_id)
LEFT JOIN `fuse_laravel_test`.districts ON districts.d7_id = om.gid
WHERE NOT ISNULL(districts.id);

-- TODO: Artifacts

-- Level Saves
-- Exclude Saves from deleted users.
INSERT INTO `fuse_laravel_test`.artifacts (
  type, artifactable_type, artifactable_id,
  name, d7_id
)
SELECT
  'save', 'level', levels.id,
  n.title, n.nid
FROM `fuse`.node n
RIGHT JOIN `fuse`.field_data_field_child_levels fdfcl ON fdfcl.entity_type = 'node' AND fdfcl.bundle ='student_progress_save' AND fdfcl.entity_id = n.nid
RIGHT JOIN `fuse`.node dl ON dl.nid = fdfcl.field_child_levels_nid AND dl.`type` = 'level'
LEFT JOIN `fuse_laravel_test`.levels levels ON levels.d7_id = fdfcl.field_child_levels_nid
WHERE n.`type` = 'student_progress_save' AND n.uid != 0
ORDER BY fdfcl.field_child_levels_nid;

-- Level Completes
-- Exclude Completes from deleted users.
INSERT INTO `fuse_laravel_test`.artifacts (
  type, artifactable_type, artifactable_id,
  name, d7_id
)
SELECT
  'complete', 'level', levels.id,
  n.title, n.nid
FROM `fuse`.node n
RIGHT JOIN `fuse`.field_data_field_child_levels fdfcl ON fdfcl.entity_type = 'node' AND fdfcl.bundle ='level_completion_proof' AND fdfcl.entity_id = n.nid
RIGHT JOIN `fuse`.node dl ON dl.nid = fdfcl.field_child_levels_nid AND dl.`type` = 'level'
LEFT JOIN `fuse_laravel_test`.levels levels ON levels.d7_id = fdfcl.field_child_levels_nid
WHERE n.`type` = 'level_completion_proof' AND n.uid != 0
ORDER BY fdfcl.field_child_levels_nid;

-- Ideas
INSERT INTO `fuse_laravel_test`.ideas (
  created_at, updated_at,
  name, body, copied_from_level, d7_id
)
SELECT
  FROM_UNIXTIME(n.created), FROM_UNIXTIME(n.changed),
  n.title, fdb.body_value, l.id, n.nid
FROM `fuse`.node n
LEFT JOIN `fuse`.field_data_body fdb ON fdb.entity_id = n.nid AND fdb.entity_type = 'node' AND fdb.bundle = 'idea_level'
LEFT JOIN `fuse`.field_data_field_level_copied fdflc ON fdflc.entity_id = n.nid AND fdflc.entity_type = 'node' AND fdflc.bundle = 'idea_level'
LEFT JOIN `fuse_laravel_test`.levels l ON l.d7_id = fdflc.field_level_copied_target_id
WHERE n.`type` = 'idea_level' AND n.uid != 0;

-- Idea inspirations
INSERT INTO `fuse_laravel_test`.idea_inspirations (idea_id, challenge_version_id)
SELECT
  i.id, cv.id
FROM `fuse`.field_data_field_inspiration fdfi
LEFT JOIN `fuse_laravel_test`.ideas i ON i.d7_id = fdfi.entity_id
LEFT JOIN `fuse_laravel_test`.challenge_versions cv ON cv.d7_id = fdfi.field_inspiration_target_id
WHERE fdfi.entity_type = 'node' AND fdfi.bundle = 'idea_level';

-- Attach teams to ideas.
-- First Drupal node owners.
INSERT INTO `fuse_laravel_test`.teams (teamable_type, teamable_id, user_id)
SELECT 'idea', i.id as idea_id, u.id as user_id
FROM `fuse_laravel_test`.ideas i
LEFT JOIN `fuse`.node n ON n.nid = i.d7_id
LEFT JOIN `fuse_laravel_test`.users u ON u.d7_id = n.uid
WHERE NOT ISNULL(u.id);

-- Then the rest of the team.
INSERT INTO `fuse_laravel_test`.teams (teamable_type, teamable_id, user_id)
SELECT 'idea', i.id as idea_id, u.id as user_id
FROM `fuse_laravel_test`.ideas i
RIGHT JOIN `fuse`.field_data_field_teammates fdft ON fdft.entity_type = 'node' AND fdft.entity_id = i.d7_id
RIGHT JOIN `fuse_laravel_test`.users u ON u.d7_id = fdft.field_teammates_target_id
WHERE !ISNULL(i.d7_id);

-- Idea Saves
INSERT INTO `fuse_laravel_test`.artifacts (
  type, artifactable_type, artifactable_id,
  name, d7_id
)
SELECT
  'save', 'idea', levels.id,
  n.title, n.nid
FROM `fuse`.node n
RIGHT JOIN `fuse`.field_data_field_child_levels fdfcl ON fdfcl.entity_type = 'node' AND fdfcl.bundle ='student_progress_save' AND fdfcl.entity_id = n.nid
RIGHT JOIN `fuse`.node dl ON dl.nid = fdfcl.field_child_levels_nid AND dl.`type` = 'idea'
LEFT JOIN `fuse_laravel_test`.levels levels ON levels.d7_id = fdfcl.field_child_levels_nid
WHERE n.`type` = 'student_progress_save' AND n.uid != 0
ORDER BY fdfcl.field_child_levels_nid;

-- Idea Completes
-- Exclude Completes from deleted users.
INSERT INTO `fuse_laravel_test`.artifacts (
  type, artifactable_type, artifactable_id,
  name, d7_id
)
SELECT
  'complete', 'level', levels.id,
  n.title, n.nid
FROM `fuse`.node n
RIGHT JOIN `fuse`.field_data_field_child_levels fdfcl ON fdfcl.entity_type = 'node' AND fdfcl.bundle ='level_completion_proof' AND fdfcl.entity_id = n.nid
RIGHT JOIN `fuse`.node dl ON dl.nid = fdfcl.field_child_levels_nid AND dl.`type` = 'level'
LEFT JOIN `fuse_laravel_test`.levels levels ON levels.d7_id = fdfcl.field_child_levels_nid
WHERE n.`type` = 'level_completion_proof' AND n.uid != 0
ORDER BY fdfcl.field_child_levels_nid;

-- Attach teams to artifacts.
-- First Drupal node owners.
INSERT INTO `fuse_laravel_test`.teams (teamable_type, teamable_id, user_id)
SELECT 'artifact', a.id as artifact_id, u.id as user_id
FROM `fuse_laravel_test`.artifacts a
LEFT JOIN `fuse`.node n ON n.nid = a.d7_id
LEFT JOIN `fuse_laravel_test`.users u ON u.d7_id = n.uid;

-- Then the rest of the team.
INSERT INTO `fuse_laravel_test`.teams (teamable_type, teamable_id, user_id)
SELECT 'artifact', a.id as artifact_id, u.id as user_id
FROM `fuse_laravel_test`.artifacts a
RIGHT JOIN `fuse`.field_data_field_teammates fdft ON fdft.entity_type = 'node' AND fdft.entity_id = a.d7_id
RIGHT JOIN `fuse_laravel_test`.users u ON u.d7_id = fdft.field_teammates_target_id
WHERE !ISNULL(a.d7_id);

-- TODO: Comments

-- TODO: Comment Seen

-- TODO: Activity Log
-- N.B. - This is likely to move out of the database sooner than later.
-- This takes almost 9 minutes to run. Can we hasten it? 5.4M records.
INSERT INTO `fuse_laravel_test`.activity_log (
  id,
  created_at,
  d7_uid, d7_lid,
  -- user_id, level_id,
  birthday, gender, ethnicity,
  activity_type, d7_afilliated_studios,
  d7_studio_nid,
  -- studio_id,
  studio_name,
  challenge_title, challenge_version, level_number,
  d7_artifact_nid,
  -- artifact_id,
  artifact_name, artifact_url,
  is_team_artifact,
  trigger_activity_id,
  d7_school_nid,
  -- school_id,
  school_name,
  d7_district_nid,
  -- district_id,
  district_name,
  is_idea_level,
  is_facilitator
)
SELECT fal.aid,
  FROM_UNIXTIME(fal.timestamp), -- users.id as user_id, levels.id as level,
  fal.uid, fal.lid,
  fal.birthday as birthday, fal.gender as gender, fal.ethnicity as ethnicity,
  fal.activity_type, fal.affiliated_studios,
  fal.studio_nid,
  -- studios.id as studio,
  fal.studio_name as studio_name,
  fal.challenge_title as challenge, fal.challenge_version as c_version, fal.level_number as l_no,
  fal.artifact_nid,
  -- artifacts.id as artifact_id,
  fal.artifact_name as artifact_name, fal.artifact_url as artifact_url,
  COALESCE(fal.is_team_artifact, 0) as 'team?',
  fal.trigger_aid,
  fal.school_nid,
  -- schools.id as school_id,
  fal.school_name as school_name,
  fal.district_nid,
  -- districts.id as district_id,
  fal.district_name as district_name,
  fal.is_idea_level,
  fal.is_facilitator
FROM `fuse`.fuse_activity_log fal;
-- RIGHT OUTER JOIN `fuse_laravel_test`.users users ON users.d7_id = fal.uid
-- LEFT JOIN `fuse_laravel_test`.levels levels ON levels.d7_id = fal.lid
-- LEFT JOIN `fuse_laravel_test`.studios studios ON studios.d7_id = fal.studio_nid
-- LEFT JOIN `fuse_laravel_test`.artifacts artifacts ON artifacts.d7_id = fal.artifact_nid
-- LEFT JOIN `fuse_laravel_test`.schools schools ON schools.d7_id = fal.school_nid
-- LEFT JOIN `fuse_laravel_test`.districts districts ON districts.d7_id = fal.school_nid

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.users u ON log.d7_uid = u.d7_id
SET log.user_id = u.id;

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.levels l ON log.d7_lid = l.d7_id
SET log.level_id = l.id;

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.studios s ON log.d7_studio_nid = s.d7_id
SET log.studio_id = s.id;

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.artifacts a ON log.d7_artifact_nid = a.d7_id
SET log.artifact_id = a.id;

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.schools s ON log.d7_school_nid = s.d7_id
SET log.school_id = s.id;

UPDATE `fuse_laravel_test`.activity_log log
LEFT JOIN `fuse_laravel_test`.districts d ON log.d7_district_nid = d.d7_id
SET log.district_id = d.id;

--Drop temp D7 migration columns.
-- ALTER TABLE `fuse_laravel_test`.users DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_categories DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.challenges DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_versions DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_versions DROP d7_challenge_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_versions DROP d7_challenge_category_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_versions DROP d7_prereq_challenge_id;
-- ALTER TABLE `fuse_laravel_test`.levels DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.levels DROP d7_challenge_version_id;
-- ALTER TABLE `fuse_laravel_test`.levels DROP d7_prereq_level_id;
-- ALTER TABLE `fuse_laravel_test`.l_t_i_platforms DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.packages DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_package DROP d7_challenge_id;
-- ALTER TABLE `fuse_laravel_test`.challenge_package DROP d7_package_id;
-- ALTER TABLE `fuse_laravel_test`.roles DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.role_user DROP d7_rid;
-- ALTER TABLE `fuse_laravel_test`.role_user DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.artifacts DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.districts DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.district_user DROP d7_district_id;
-- ALTER TABLE `fuse_laravel_test`.district_user DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.schools DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.school_user DROP d7_school_id;
-- ALTER TABLE `fuse_laravel_test`.school_user DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.studios DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.studios DROP d7_school_id;
-- ALTER TABLE `fuse_laravel_test`.studios DROP d7_package_id;
-- ALTER TABLE `fuse_laravel_test`.studios MODIFY COLUMN join_code varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NOT NULL;
-- ALTER TABLE `fuse_laravel_test`.studio_user DROP d7_studio_id;
-- ALTER TABLE `fuse_laravel_test`.studio_user DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.ideas DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.idea_inspirations DROP d7_idea_id;
-- ALTER TABLE `fuse_laravel_test`.idea_inspirations DROP d7_challenge_version_id;
-- ALTER TABLE `fuse_laravel_test`.comments DROP d7_artifact_id;
-- ALTER TABLE `fuse_laravel_test`.comments DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.comment_seen DROP d7_comment_id;
-- ALTER TABLE `fuse_laravel_test`.comment_seen DROP d7_uid;
-- ALTER TABLE `fuse_laravel_test`.partners DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.schools DROP d7_partner_id;
-- ALTER TABLE `fuse_laravel_test`.grade_levels DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.activity_log DROP d7_id;
-- ALTER TABLE `fuse_laravel_test`.activity_log DROP d7_trigger_id;
-- ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN affiliated_studios varchar(2047) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
-- ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN studio_id bigint(20) unsigned NOT NULL;
-- ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN studio_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
-- ALTER TABLE `fuse_laravel_test`.activity_log MODIFY COLUMN user_id bigint(20) unsigned NOT NULL;