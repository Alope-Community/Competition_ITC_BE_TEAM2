<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donation::insert([
            [
                'title' => 'Education for All',
                'description' => 'Support underprivileged children in getting quality education.',
                'category' => 'Education',
                'donation_url' => 'http://example.com/education-donate',
                'web_url' => 'http://example.com/education',
                'image_url' => 'http://example.com/education.jpg',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Flood Relief Fund',
                'description' => 'Help families affected by severe flooding.',
                'category' => 'Disaster Relief',
                'donation_url' => 'http://example.com/flood-donate',
                'web_url' => 'http://example.com/flood-relief',
                'image_url' => 'http://example.com/flood.jpg',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
