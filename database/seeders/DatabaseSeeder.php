<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin123',
            'Role' => 'admin',

        ]);
        User::factory()->create([
            'name' => 'Jonathan',
            'email' => 'jonathan@example.com',
            'password' => 'jonat123',
            'Role' => 'yayasan/organisasi/komunitas',

        ]);
        User::factory()->create([
            'name' => 'Taufan',
            'email' => 'taufan@gmail.com',
            'password' => 'taufan123',
            'Role' => 'user',

        ]);

        $this->call([
            VolunteerSeeder::class,
            DonationSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
