<?php

namespace Database\Seeders;

use App\Models\SpecialUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use WithoutModelEvents;
    public function run(): void
    {
        //
        SpecialUser::factory()->create([
            'email' => 'adminjkbfest@gmail.com',
            'password' => password_hash('jkbfest2026Z@' , PASSWORD_DEFAULT)
        ]);

    }
}
