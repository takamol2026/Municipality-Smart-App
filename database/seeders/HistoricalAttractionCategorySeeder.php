<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\HistoricalAttractionCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class HistoricalAttractionCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(HistoricalAttractionCategory::class, ['slug' => "historical-category-{$i}"], [
                'name' => "دسته‌بندی جاذبه تاریخی {$i}",
                'lang' => Language::All,
                'description' => "توضیحات دسته‌بندی جاذبه تاریخی {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
