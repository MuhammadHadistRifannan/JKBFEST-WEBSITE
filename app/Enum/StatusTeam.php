<?php

namespace App\Enum;

enum StatusTeam : string
{
    //
    case pending = 'pending';
    case verified = 'verified';
    case declined = 'declined';
}
