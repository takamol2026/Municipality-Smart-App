<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\UrbanService;
use App\Models\UrbanServiceCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class UrbanServiceSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = UrbanServiceCategory::query()->where('slug', 'like', 'urban-category-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(UrbanService::class, ['slug' => "urban-service-{$i}"], [
                'urban_service_category_id' => $categories["urban-category-{$i}"],
                'name' => "خدمت شهری {$i}",
                'lang' => Language::All,
                'short_description' => "خلاصه خدمت شهری {$i}.",
                'description' => "شرح کامل خدمت شهری شماره {$i} در شاروالی هرات.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
