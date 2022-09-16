<?php

use App\Enums\ChallengeVersionStatus as CVS;
use App\Models\ChallengeVersion;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\throwException;

return new class extends Migration
{
    public function up()
    {
        // Only run this if ChallengeVersions has the SoftDeletes trait.
        $traits = class_uses_recursive(ChallengeVersion::class);
        if (! Arr::exists($traits, SoftDeletes::class)) {
            throwException(new Error('Make sure ChallengeVersion implements SoftDeletes before rolling back this migration.'));
        }

        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->enum('status', array_map(fn($val) => $val->value, CVS::cases()))
                  ->default(CVS::Beta->value);
        });

        $challengeVersions = ChallengeVersion::withTrashed()->get();
        foreach ($challengeVersions as $challengeVersion) {
            if ($challengeVersion->trashed()) {
                $challengeVersion->status = CVS::Archive;
            }
            else if ($challengeVersion->challenge_category_id == 7) {
                $challengeVersion->status = CVS::Legacy;
            }
            else if ($challengeVersion->challenge_category_id == 8) {
                $challengeVersion->status = CVS::Beta;
            }
            else {
                $challengeVersion->status = CVS::Current;
            }
            $challengeVersion->save();
        }

        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('challenge_categories', function (Blueprint $table) {
            $table->dropColumn('disapproved');
        });
    }

    public function down()
    {
        // Only run this if ChallengeVersions has the SoftDeletes trait.
        $traits = class_uses_recursive(ChallengeVersion::class);
        if (! Arr::exists($traits, SoftDeletes::class)) {
            throwException(new Error('Make sure ChallengeVersion implements SoftDeletes before rolling back this migration.'));
        }

        Schema::table('challenge_categories', function (Blueprint $table) {
            $table->boolean('disapproved')
                ->default(0)
                ->nullable(false)
                ->description('Challenge is not fully tested, or has been deprecated.');
        });
        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->softDeletes();
        });

        $challengeVersions = ChallengeVersion::all();
        foreach ($challengeVersions as $challengeVersion) {
            if ($challengeVersion->status == CVS::Archive) {
                $challengeVersion->delete();
            }
            else {
                if ($challengeVersion->status == CVS::Legacy) {
                    $challengeVersion->challenge_category_id = 7;
                }
                else if ($challengeVersion->status == CVS::Beta) {
                    $challengeVersion->challenge_category_id = 8;
                }
                $challengeVersion->save();
            }
        }

        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
    }
};
