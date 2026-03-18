<?php

namespace Database\Seeders;

use App\Models\SpecialUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        SpecialUser::factory()->create([
            'email' => env('ADMIN_EMAIL'),
            'password' => password_hash(env('ADMIN_PASSWORD') , PASSWORD_DEFAULT)
        ]);
    }
}
