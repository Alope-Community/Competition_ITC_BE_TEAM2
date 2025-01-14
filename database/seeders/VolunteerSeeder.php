<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Volunteer;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Volunteer::insert([
            [
                'user_id' => '1',
                'title' => 'Beach Cleanup Program',
                'description' => 'Join us to clean up the local beaches.',
                'category' => 'Environment, Clean, Earth',
                'contact_phone' => '08123456789',
                'contact_instagram' => '@beachcleanup',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/volunteer/volunteer-default.png',
                'status' => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Tree Planting Campaign',
                'description' => 'Help us plant trees in the urban areas.',
                'category' => 'Environment, Clean, Earth',
                'contact_phone' => '08198765432',
                'contact_instagram' => '@treeplanting',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/volunteer/volunteer-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'title' => 'Tree Planting Campaign',
                'description' => 'Help us plant trees in the urban areas.',
                'category' => 'Environment, Clean, Earth',
                'contact_phone' => '08198765432',
                'contact_instagram' => '@treeplanting',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/volunteer/volunteer-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Tree Planting Campaign',
                'description' => 'Help us plant trees in the urban areas.',
                'category' => 'Environment, Clean, Earth',
                'contact_phone' => '08198765432',
                'contact_instagram' => '@treeplanting',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/volunteer/volunteer-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Tree Planting Campaign',
                'description' => 'Help us plant trees in the urban areas.',
                'category' => 'Environment, Clean, Earth',
                'contact_phone' => '08198765432',
                'contact_instagram' => '@treeplanting',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/volunteer/volunteer-default.png',
                'status' => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
