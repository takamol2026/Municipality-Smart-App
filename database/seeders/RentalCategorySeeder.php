<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\RentalCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class RentalCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(RentalCategory::class, ['slug' => "rental-category-{$i}"], [
                'name' => "دسته‌بندی اجاره {$i}",
                'lang' => Language::All,
                'description' => "توضیحات دسته‌بندی اجاره {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
