<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\HistoricalAttraction;
use App\Models\HistoricalAttractionCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class HistoricalAttractionSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = HistoricalAttractionCategory::query()->where('slug', 'like', 'historical-category-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(HistoricalAttraction::class, ['slug' => "historical-{$i}"], [
                'historical_attraction_category_id' => $categories["historical-category-{$i}"],
                'name' => "جاذبه تاریخی {$i}",
                'short_description' => "خلاصه جاذبه تاریخی {$i} در هرات.",
                'description' => "توضیحات جاذبه تاریخی شماره {$i}.",
                'history' => "پیشینه جاذبه تاریخی شماره {$i}.",
                'address' => "آدرس جاذبه تاریخی {$i}، هرات",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
