<?php

namespace App\Enums;

enum ChallengeVersionStatus: string
{
    case Beta = 'B';
    case Current = 'C';
    case Legacy = 'L';
    case Archive = 'Z';
}
