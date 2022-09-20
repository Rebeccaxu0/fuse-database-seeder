<?php

use App\Enums\ChallengeStatus as Status;
use App\Models\Challenge;
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
        // Only run this if models Challenge and ChallengeVersions have the
        // SoftDeletes trait.
        $cTraits = class_uses_recursive(Challenge::class);
        $cvTraits = class_uses_recursive(ChallengeVersion::class);
        if (! Arr::exists($cTraits, SoftDeletes::class)
            && ! Arr::exists($cvTraits, SoftDeletes::class)) {
            // 'Make sure both Challenge and ChallengeVersion models implement SoftDeletes before rolling back this migration.');
            return;
        }

        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->enum('status', array_map(fn($val) => $val->value, Status::cases()))
                  ->default(Status::Beta->value);
        });

        $challengeVersions = ChallengeVersion::withTrashed()->get();
        foreach ($challengeVersions as $challengeVersion) {
            if ($challengeVersion->trashed()) {
                $challengeVersion->status = Status::Archive;
            }
            else if ($challengeVersion->challenge_category_id == 7) {
                $challengeVersion->status = Status::Legacy;
            }
            else if ($challengeVersion->challenge_category_id == 8) {
                $challengeVersion->status = Status::Beta;
            }
            else {
                $challengeVersion->status = Status::Current;
            }
            $challengeVersion->save();
        }

        Schema::table('challenge_versions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('challenges', function (Blueprint $table) {
            $table->enum('status', array_map(fn($val) => $val->value, Status::cases()))
                  ->default(Status::Current->value);
        });
        $legacychallenge = Challenge::where('name', '(Legacy)')->first();
        $legacychallenge->status = Status::Legacy;
        $legacychallenge->save();
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('challenge_categories', function (Blueprint $table) {
            $table->dropColumn('disapproved');
        });
    }

    public function down()
    {
        // Only run this if the Challenge and ChallengeVersion models have the
        // SoftDeletes trait.
        $cTraits = class_uses_recursive(Challenge::class);
        $cvTraits = class_uses_recursive(ChallengeVersion::class);
        if (! Arr::exists($cTraits, SoftDeletes::class)
            && ! Arr::exists($cvTraits, SoftDeletes::class)) {
            // 'Make sure both Challenge and ChallengeVersion models implement SoftDeletes before rolling back this migration.');
            return;
        }

        Schema::table('challenges', function (Blueprint $table) {
            $table->dropColumn(['status']);
            $table->softDeletes();
        });

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
            if ($challengeVersion->status == Status::Archive) {
                $challengeVersion->delete();
            }
            else {
                if ($challengeVersion->status == Status::Legacy) {
                    $challengeVersion->challenge_category_id = 7;
                }
                else if ($challengeVersion->status == Status::Beta) {
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
