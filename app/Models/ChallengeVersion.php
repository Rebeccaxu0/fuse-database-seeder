<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Spatie\Translatable\HasTranslations;

class ChallengeVersion extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['facilitator_notes'];

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
    public function category()
    {
      return $this->belongsTo(ChallengeCategory::class, 'challenge_category_id');
    }

    /**
     * Order the associated levels.
     *
     * @param array $order
     * Array where key is level id and value is order number.
     */
    public function set_levels_order(array $order)
    {
      $ids = array_keys($order);
      $case_update_q = 'CASE id ';
      foreach ($order as $id => $level_number) {
        $case_update_q .= "WHEN {$id} THEN {$level_number} ";
      }
      $case_update_q .= 'END';
      $nulls = \DB::table('levels')
        ->whereIn('id', $ids)
        ->update(['level_number' => null]);
      $reordered = \DB::table('levels')
        ->whereIn('id', $ids)
        ->update(['level_number' => \DB::raw($case_update_q)]);
    }
}
