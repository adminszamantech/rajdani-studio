<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebsiteSetting;
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
            'email' => 'admin@gmail.com',
        ]);

        WebsiteSetting::create([
            'phone' => '01700000000',
            'email' => 'website@gmail.com',
            'address' => 'Testing Address',
            'facebook_link' => 'dummy link',
            'linkedin_link' => 'dummy link',
            'twitter_link' => 'dummy link',
        ]);
    }
}
