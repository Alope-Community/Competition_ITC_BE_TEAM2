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
                'title' => 'Beach Cleanup Program',
                'description' => 'Join us to clean up the local beaches.',
                'category' => 'Environment',
                'contact_phone' => '08123456789',
                'contact_instagram' => '@beachcleanup',
                'image_url' => 'http://example.com/beach.jpg',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tree Planting Campaign',
                'description' => 'Help us plant trees in the urban areas.',
                'category' => 'Environment',
                'contact_phone' => '08198765432',
                'contact_instagram' => '@treeplanting',
                'image_url' => 'http://example.com/tree.jpg',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
