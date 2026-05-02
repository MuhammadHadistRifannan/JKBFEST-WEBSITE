<?php

namespace App\Services;

use Carbon\Carbon;

class  DeadlineService
{
    /**
     * Batas waktu pendaftaran / upload
     */
    public static function deadline(): Carbon
    {
        return Carbon::create(2026, 5, 10, 23, 59, 59);
    }

    /**
     * Cek apakah sudah expired
     */
    public static function isExpired(): bool
    {
        return now()->greaterThan(self::deadline());
    }

    /**
     * Route yang tetap perlu dicek
     */
    public static function preservedRoutes(): array
    {
        return [
            'teamPeserta',
            'addTeam',
            'uploadKarya',
        ];
    }
}