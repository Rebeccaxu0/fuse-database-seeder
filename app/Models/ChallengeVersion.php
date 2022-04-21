<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;
use Spatie\Translatable\HasTranslations;

class ChallengeVersion extends Model
{
    use HasFactory;
    use HasTranslations;
    use Mediable;
    use SoftDeletes;

    public $translatable = ['blurb', 'facilitator_notes', 'gallery_note', 'name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'challenge_id',
        'challenge_category_id',
        'gallery_version_desc_short',
        'blurb',
        'summary',
        'chromebook_info',
        'stuff_you_need',
        'facilitator_notes',
        'prerequisite_challenge_version_id',
        'info_article_url'
    ];

    /**
     * The challenge that owns this challenge version.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * The levels associated with this challenge.
     */
    public function levels()
    {
        return $this->morphMany(Level::class, 'levelable');
    }

    /**
     * The Ideas inspired by this challenge.
     */
    public function ideas()
    {
        return $this->belongsToMany(Idea::class, 'idea_inspirations');
    }

    /**
     * The category this Challenge version is tagged with.
     */
    public function challengeCategory()
    {
        return $this->belongsTo(ChallengeCategory::class, 'challenge_category_id');
    }

    /**
     * Prerequisite ChallengeVersion, if any, usually previous level in sequence.
     */
    public function prerequisiteChallengeVersion()
    {
        return $this->belongsTo(ChallengeVersion::class, 'prerequisite_challenge_version_id');
    }

    /**
     * The Studios this challenge is active in.
     */
    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    /**
     * Order the associated levels.
     *
     * @param array $order
     * Array where key is level id and value is order number.
     */
    public function setLevelsOrder(array $order)
    {
        $ids = array_keys($order);
        $case_update_q = 'CASE id ';
        foreach ($order as $id => $level_number) {
            $case_update_q .= "WHEN {$id} THEN {$level_number} ";
        }
        $case_update_q .= 'END';
        $nulls = DB::table('levels')
            ->whereIn('id', $ids)
            ->update(['level_number' => null]);
        $reordered = DB::table('levels')
            ->whereIn('id', $ids)
            ->update(['level_number' => DB::raw($case_update_q)]);
    }

    /**
     * Get the number of students online that have started this challenge.
     */
    public function activeStudents(Studio $studio)
    {
        return 0;
        $others_working = db_select('users', 'u');
        $others_working->join('field_data_field_current_level', 'c_l', 'c_l.entity_id = u.uid');
        $others_working->condition('c_l.field_current_level_nid', $list_of_challenge_levels, 'IN');
        $others_working->join('og_membership', 'og', "og.etid = u.uid AND og.entity_type = 'user'");
        $others_working
          ->condition('u.uid', $exclude_uids_q, 'NOT IN')
          ->condition('og.state', 1)
          ->condition('og.gid', $studio_nid)
          ->condition('og.group_type', 'node');

    }
}

