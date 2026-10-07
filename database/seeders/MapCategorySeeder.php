<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\MapCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class MapCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(MapCategory::class, ['slug' => "map-category-{$i}"], [
                'name' => "دسته‌بندی نقشه {$i}",
                'description' => "توضیحات دسته‌بندی نقشه {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
