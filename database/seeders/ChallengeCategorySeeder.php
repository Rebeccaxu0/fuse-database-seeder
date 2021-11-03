<?php

namespace Database\Seeders;

use App\Models\ChallengeCategory;
use Illuminate\Database\Seeder;

class ChallengeCategorySeeder extends Seeder
{
    private $defaults = [
      'Digital Only' => 'Challenges that can be done in a browser or on a computer with installed software.',
      'DIY Kit' => 'Hands-on challenges that require simple materials found in your classroom or at home.',
      '3D Printing' => 'Users design parts in browser-based software (Tinkercad and Onshape) and then transfer the files for 3D printing.',
      'Kit Only' => 'Challenges that rely exclusively on physical materials like electronics, lasers and mirror, etc.',
      'Kit + Digital' => 'Challenges that require both a kit and a Chromebook or computer for completion.',
      'Legacy' => 'These are older versions of Challenges. We strongly discourage using these versions. These may rely on older physical kits, or on software that does not run in a browser. Sketchup is not recommended for 3D printing challenges.',
      'Beta' => 'Challenges that are still in the design and refinement stage.',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ($this->defaults as $name => $desc) {
        $category = ChallengeCategory::factory();
        $category->create([
            'name' => $name,
            'description' => $desc,
          ]);
      }
    }
}
