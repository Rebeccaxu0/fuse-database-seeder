-- Insert Challenge Taxonomy Terms
INSERT INTO fuse_laravel.challenges (name, description, d7_id)
SELECT name, description, tid as d7_id from fuse.taxonomy_term_data ttd WHERE ttd.vid = (
SELECT fuse.taxonomy_vocabulary.vid
FROM fuse.taxonomy_vocabulary taxonomy_vocabulary
WHERE (taxonomy_vocabulary.machine_name = 'challenges')
)
ORDER BY name;

-- Insert Challenge Versions
INSERT INTO fuse_laravel.challenge_versions (name, challenge_id, d7_id, d7_challenge_id)
SELECT n.title as name, 1 as challenge_id, n.nid as d7_id, ttd.tid as d7_challenge_id
FROM fuse.node AS n
LEFT JOIN fuse.field_data_field_version_of AS fdfvo ON
  (fdfvo.entity_type = 'node'
  AND fdfvo.bundle = 'challenge'
  AND fdfvo.entity_id = n.nid)
JOIN fuse.taxonomy_term_data ttd
ON ttd.tid = fdfvo.field_version_of_target_id
 WHERE n.type = 'challenge'
ORDER BY n.title ASC;

-- Update foriegn keys
UPDATE fuse_laravel.challenge_versions cv
LEFT JOIN fuse_laravel.challenges c ON cv.d7_challenge_id = c.d7_id
SET cv.challenge_id = c.id;