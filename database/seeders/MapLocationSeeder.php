<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\MapCategory;
use App\Models\MapLocation;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class MapLocationSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = MapCategory::query()->where('slug', 'like', 'map-category-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(MapLocation::class, ['slug' => "map-location-{$i}"], [
                'map_category_id' => $categories["map-category-{$i}"],
                'name' => "مکان نقشه {$i}",
                'lang' => Language::All,
                'description' => "توضیحات مکان نقشه {$i}.",
                'address' => "آدرس مکان {$i}، هرات",
                'phone' => '041'.str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
