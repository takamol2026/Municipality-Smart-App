<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\UrbanServiceCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class UrbanServiceCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(UrbanServiceCategory::class, ['slug' => "urban-category-{$i}"], [
                'name' => "دسته‌بندی خدمات شهری {$i}",
                'description' => "توضیحات دسته‌بندی خدمات شهری {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
