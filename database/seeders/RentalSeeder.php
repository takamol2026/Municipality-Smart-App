<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\Rental;
use App\Models\RentalCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = RentalCategory::query()->where('slug', 'like', 'rental-category-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(Rental::class, ['slug' => "rental-{$i}"], [
                'rental_category_id' => $categories["rental-category-{$i}"],
                'name' => "مورد اجاره {$i}",
                'description' => "توضیحات مورد اجاره {$i}.",
                'address' => "آدرس مورد اجاره {$i}، هرات",
                'rental_price' => 5000 + ($i * 100),
                'rental_period' => $i % 2 === 0 ? 12 : 6,
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
