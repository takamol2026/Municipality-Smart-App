<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RoleUserSeeder::class,
            DistrictSeeder::class,
            DistrictFileSeeder::class,
            UrbanServiceCategorySeeder::class,
            UrbanServiceSeeder::class,
            HistoricalAttractionCategorySeeder::class,
            HistoricalAttractionSeeder::class,
            ScholarSeeder::class,
            AnnouncementCategorySeeder::class,
            AnnouncementSeeder::class,
            ProjectCategorySeeder::class,
            ProjectSeeder::class,
            ProjectMediaSeeder::class,
            MapCategorySeeder::class,
            MapLocationSeeder::class,
            MapMediaSeeder::class,
            RentalCategorySeeder::class,
            RentalSeeder::class,
            SafaeiCategorySeeder::class,
            SafaeiSeeder::class,
            ComplaintSeeder::class,
        ]);
    }
}
