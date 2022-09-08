<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            FormSeeder::class,
            SubjectSeeder::class,
            ClassSeeder::class,
            AnnouncementSeeder::class,
            FolderSeeder::class,
            ContentSeeder::class,
            DiscussionSeeder::class,
        ]);
    }
}
