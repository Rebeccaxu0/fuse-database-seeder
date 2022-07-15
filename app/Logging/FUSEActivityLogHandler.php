<?php

namespace App\Logging;

// use Illuminate\Log\Logger;
use DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class FUSEActivityLogHandler extends AbstractProcessingHandler
{
    /**
     *
     * Reference:
     * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
     */
    public function __construct($level = Logger::INFO, $bubble = true)
    {
        $this->table = 'activity_log';
        parent::__construct($level, $bubble);
    }

    protected function write(array $record):void
    {
        if (array_key_exists('user', $record['context'])) {
            $user = $record['context']['user'];
            $studio_id = $studio_name = null;
            $school_id = $school_name = null;
            $district_id = $district_name = null;
            // For add/remove from studio, we need to pass the studio explicitly.
            if (array_key_exists('studio', $record['context'])) {
                $studio = $record['context']['studio'];
                $studio_id = $studio->id;
                $studio_name = $studio->name;
                if ($studio->school) {
                    $school_id = $studio->school->id;
                    $school_name = $studio->school->name;
                    if ($studio->school->district) {
                        $district_id = $studio->district->id;
                        $district_name = $studio->district->name;
                    }
                }
            }
            // Use active studio for non studio-volatile activity like save/complete.
            else if ($user->activeStudio) {
                $studio_id = $user->activeStudio->id;
                $studio_name = $user->activeStudio->name;
                if ($user->activeStudio->school) {
                    $school_id = $user->activeStudio->school->id;
                    $school_name = $user->activeStudio->school->name;
                    if ($user->activeStudio->school->district) {
                        $district_id = $user->activeStudio->district->id;
                        $district_name = $user->activeStudio->district->name;
                    }
                }
            }
            $affiliated_studios = $user->deFactoStudios()->pluck('id')->implode(', ');

            $artifact = array_key_exists('artifact', $record['context'])
                ? $record['context']['artifact']
                : null;
            $artifact_id = $artifact_name = $artifact_url = null;
            $is_team_artifact = false;
            if ($artifact) {
                $artifact_id = $artifact->id;
                $artifact_name = $artifact->name;
                if ($artifact->url) {
                    $artifact_url = $artifact->url;
                }
                else {
                    $artifact_url = $artifact->downloadLink();
                }
                $is_team_artifact = $artifact->users->count() > 1;
            }
            $trigger_activity_id = array_key_exists('trigger_id', $record['context'])
                ? $record['context']['trigger_id']
                : null;

            $level = array_key_exists('level', $record['context'])
                ? $record['context']['level']
                : null;
            $level_id = $level_number = $challenge_title = $challenge_version = null;
            $is_idea_level = false;
            if ($level) {
                $level_id = $level->id;
                $level_number = $level->level_number;
                $challenge_version = $level->levelable->name;
                if ($level->levelable_type == 'idea') {
                    $is_idea_level = true;
                    $challenge_title = $level->levelable->name;
                }
                else {
                    $challenge_title = $level->levelable->challenge->name;
                }
            }

            $data = array(
                'created_at'          => date("Y-m-d H:i:s"),
                'user_id'             => $user->id,
                'level_id'            => $level_id,
                'birthday'            => $user->birthday,
                'gender'              => $user->gender,
                'ethnicity'           => $user->ethnicity,
                'activity_type'       => $record['message'],
                'affiliated_studios'  => $affiliated_studios,
                'studio_id'           => $studio_id,
                'studio_name'         => $studio_name,
                'challenge_title'     => $challenge_title,
                'challenge_version'   => $challenge_version,
                'level_number'        => $level_number,
                'artifact_id'         => $artifact_id,
                'artifact_name'       => $artifact_name,
                'artifact_url'        => $artifact_url,
                'is_team_artifact'    => $is_team_artifact,
                'trigger_activity_id' => $trigger_activity_id,
                'school_id'           => $school_id,
                'school_name'         => $school_name,
                'district_id'         => $district_id,
                'district_name'       => $district_name,
                'is_idea_level'       => $is_idea_level,
                'is_facilitator'      => $user->isFacilitator(),
            );

            DB::connection()->table($this->table)->insert($data);
        }
    }
}
