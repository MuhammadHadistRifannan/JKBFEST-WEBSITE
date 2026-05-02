<?php

namespace App\Services;

use Carbon\Carbon;

class  DeadlineService
{
    /**
     * Batas waktu pendaftaran / upload
     */
    public static function deadlineKarya(): Carbon
    {
        return Carbon::create(2026, 5, 10, 23, 59, 59);
    }

    public static function deadlineTeam(){
        return Carbon::create(2026, 5, 2, 23, 59, 59);
    }

    /**
     * Cek apakah sudah expired
     */
    public static function isExpiredKarya(): bool
    {
        return now()->greaterThan(self::deadlineKarya());
    }

    public static function isExpiredTeam(){
        return now()->greaterThan(self::deadlineTeam());
    }


    /**
     * Route yang tetap perlu dicek
     */
    public static function karyaRoute(): array
    {
        return [
            'uploadKarya',
        ];
    }

    public static function teamRoute(){
        return [

            'teamPeserta',
            'addTeam',
        ];
    }
}