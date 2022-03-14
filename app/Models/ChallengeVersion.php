<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ChallengeVersion extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['blurb', 'facilitator_notes', 'gallery_note', 'name'];

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
        return $this->hasMany(Level::class);
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
}
