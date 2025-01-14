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
                'user_id' => '1',
                'title' => 'Education for All',
                'description' => 'Support underprivileged children in getting quality education.',
                'category' => 'Education, School, Humanity',
                'donation_url' => 'http://example.com/education-donate',
                'web_url' => 'http://example.com/education',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/donation/donation-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Flood Relief Fund',
                'description' => 'Help families affected by severe flooding.',
                'category' => 'Disaster Relief, Nature, Humanity',
                'donation_url' => 'http://example.com/flood-donate',
                'web_url' => 'http://example.com/flood-relief',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/donation/donation-default.png',
                'status' => 'Tidak Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'title' => 'Flood Relief Fund',
                'description' => 'Help families affected by severe flooding.',
                'category' => 'Disaster Relief, Nature, Humanity',
                'donation_url' => 'http://example.com/flood-donate',
                'web_url' => 'http://example.com/flood-relief',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/donation/donation-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Flood Relief Fund',
                'description' => 'Help families affected by severe flooding.',
                'category' => 'Disaster Relief, Nature, Humanity',
                'donation_url' => 'http://example.com/flood-donate',
                'web_url' => 'http://example.com/flood-relief',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/donation/donation-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '2',
                'title' => 'Flood Relief Fund',
                'description' => 'Help families affected by severe flooding.',
                'category' => 'Disaster Relief, Nature, Humanity',
                'donation_url' => 'http://example.com/flood-donate',
                'web_url' => 'http://example.com/flood-relief',
                'registration_url' => 'http://example.com/registration',
                'start_date' => '2025-01-01',
                'end_date' => '2025-01-01',
                'image_url' => 'img/donation/donation-default.png',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
