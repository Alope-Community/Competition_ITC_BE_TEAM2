<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::insert([
            [
                'name' => 'John Doe',
                'position' => 'CEO',
                'content' => 'This program is fantastic! Highly recommended.',
                'photo_url' => 'http://example.com/john.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'Manager',
                'content' => 'Great initiative, and I’m proud to be part of it!',
                'photo_url' => 'http://example.com/jane.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
