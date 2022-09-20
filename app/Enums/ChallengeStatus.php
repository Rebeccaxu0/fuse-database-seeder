<?php

namespace App\Enums;

enum ChallengeStatus: string
{
    case Beta = 'B';
    case Current = 'C';
    case Legacy = 'L';
    case Archive = 'Z';

    public function label(): string
    {
        return match($this) {
            static::Beta => __('Beta'),
            static::Current => __('Current'),
            static::Legacy => __('Legacy'),
            static::Archive => __('Archive'),
        };
    }
    public function description(): string
    {
        return match($this) {
            static::Beta => __('Challenges that are still in the design and refinement stage.'),
            static::Legacy => __('These are older versions of Challenges. We strongly discourage using these versions. These may rely on older physical kits, or on software that does not run in a browser. Sketchup is not recommended for 3D printing challenges.'),
        };
    }
}
