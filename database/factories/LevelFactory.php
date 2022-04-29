<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blurb = "Make rooms in your house!";
        $challenge_desc =<<<HTML
<p dir="ltr">
  Use 3D design software to make a house that includes at least:
</p>
<ul dir="ltr">
  <li>4 Windows</li>
  <li>1 door</li>
  <li>A gable (not flat) roof</li>
  <li>Color or texture on all the walls and roof</li>
</ul>
HTML;
        $syn_desc =<<<HTML
<ul>
  <li>
    <a target="_blank" href="https://app.sketchup.com/app?hl=en">Sketchup</a>
  </li>
</ul>
HTML;
        $gs_desc =<<<HTML
<h3>Choose a building site:</h3>
<ol>
  <li>
    Open <a target="_blank" href="https://app.sketchup.com/app?hl=en">Sketchup</a> and sign in. <span class="wistia_embed wistia_async_izvhzsfsuo popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">video</a></span>
  </li>
  <li>
    Decide which building site you want to use and download it. <span class="wistia_embed wistia_async_yo41mrrsrj popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">video</a></span>
  </li>
    <p>
      <a href="/sites/default/files/DH/DH- Downtown Penthouse Building Site.skp" target="_blank">
      <img alt="Downtown Penthouse" src="/sites/default/files/styles/medium/public/Untitled%20drawing%20%281%29_0.jpg?itok=Ilqz8pdT" style="vertical-align: baseline; width: 150px;" title="Build your new home on top of the tallest skyscraper around!" />
      </a>
      <a href="/sites/default/files/storage/DH-%20Beach%20Building%20Site.skp" target="_blank">
      <img alt="Beach Front Property" src="/sites/default/files/styles/medium/public/Untitled%20drawing_0.jpg?itok=C192qecl" style="vertical-align: baseline; width: 150px;" title="There is nothing between the ocean and your new home except sand and palm trees" />
      </a>
      <a href="/sites/default/files/storage/DH-%20Neighborhood%20Block%20Building%20Site.skp" target="_blank">
      <img alt="Neighborhood Corner" src="/sites/default/files/styles/medium/public/Neighborhood%20Corner%20Preview.jpg?itok=C-a7nSh7" style="vertical-align: baseline; width: 150px;" title="Build on a tree-lined corner-lot." />
      </a>
      <a href="/sites/default/files/storage/DH-%20Suburb%20River%20Building%20Site.skp" target="_blank">
      <img alt="Suburban River View" src="/sites/default/files/styles/medium/public/Suburban%20River%20View%20Preview_0.jpg?itok=DyA02K_S" style="vertical-align: baseline; width: 150px;" title="Build on a peaceful street with a view of a river." />
      </a>
    </p>
  <li>
    Upload your building site to Sketchup. <span class="wistia_embed wistia_async_zp7i5f7ptt popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">video</a></span>
  </li>
</ol>
<h3> Start Building</h3>
<ol>
  <li>
    Make the footprint of your house.
    <span class="wistia_embed wistia_async_ajetna9c2k popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">
    Video</a></span>
  </li>
  <li>
    Make your house as tall as you want.
    <span class="wistia_embed wistia_async_78tw49xbpb popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">
    Video</a></span>
  </li>
  <li>
    Make a gable roof on your house.
    <ul>
      <li>
        Making a roof if your house has 4 sides. <span class="wistia_embed wistia_async_xsjlmukkj5 popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">
      Video</a></span>
      </li>
      <li>
        Making a roof if your house has more than 4 sides.
        <span class="wistia_embed wistia_async_cvl8t7jxqb popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">
      Video</a></span>
      </li>
    </ul>
  </li>
  <li>
    Draw doors and windows on the walls of your house. <span class="wistia_embed wistia_async_u3o0vmekl6 popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">Video</a></span>
  </li>
  <li>
    Paint and texture the outside of your house. <span class="wistia_embed wistia_async_m913d64ps4 popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">Video</a></span>
  </li>
</ol>
HTML;
        $htc_desc =<<<HTML
<p>
  Take a screenshot of your house. <span class="wistia_embed wistia_async_0vpkzsmg57 popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a class="icon icon-video-link" href="#">
Video</a></span>
</p>
<p>
  Click on &ldquo;Complete level&rdquo; to upload the screenshot of your design and move on to Level 2: creating an interior!
</p>
HTML;
        $gh_desc =<<<HTML
<ul>
  <li><span class="wistia_embed wistia_async_o0v6syk5fl popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a href="#">How do I navigate in Sketchup?</a></span></li>
  <li><span class="wistia_embed wistia_async_dgtu6crr5u popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a href="#">What is this blue box around everything?</a></span></li>
  <li><span class="wistia_embed wistia_async_z5l06qqhml popover=true popoverAnimateThumbnail=true popoverContent=link videoFoam=true" style="display:inline"><a href="#">What file do I use to save or complete?</a></span></li>
</ul>
HTML;
        $pu_desc =<<<HTML
<h3>Here are a few things you might want to think about:</h3>
<ul>
  <li>Is your building the right size for a person?&nbsp;<span class="wistia_embed wistia_async_7pran8w4em popover=true popoverAnimateThumbnail=true popoverContent=link" style="display:inline"><a class="icon icon-video-link" href="#">Video</a></span></li>
  <li>How will people get to your home from the street?&nbsp;<span class="wistia_embed wistia_async_0wjcqy3j35 popover=true popoverAnimateThumbnail=true popoverContent=link" style="display:inline"><a class="icon icon-video-link" href="#">Video</a></span></li>
  <li>Does your house have space for a yard?</li><li>Do your building&rsquo;s colors and materials fit in with the rest of the buildings on the block or environment?</li>
</ul>
HTML;
        return [
            'blurb' => $blurb,
            'challenge_desc' => $challenge_desc,
            'stuff_you_need_desc' => $syn_desc,
            'get_started_desc' => $gs_desc,
            'how_to_complete_desc' => $htc_desc,
            'get_help_desc' => $gh_desc,
            'power_up_desc' => $pu_desc,
        ];
    }
}
