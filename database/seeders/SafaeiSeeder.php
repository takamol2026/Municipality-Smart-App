<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\Safaei;
use App\Models\SafaeiCategory;
use App\Models\SafaeiPhoto;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class SafaeiSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = SafaeiCategory::query()->where('name', 'like', 'دسته صفایی %')->pluck('id', 'name');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $safaei = $this->upsert(Safaei::class, [
                'title' => "صفایی {$i}",
                'lang' => Language::All,
            ], [
                'safaei_category_id' => $categories["دسته صفایی {$i}"],
                'description' => "توضیحات صفایی {$i}.",
                'annual_fee' => (string) (1000 * $i),
                'payment_condition' => 'سالانه',
                'status' => RecordStatus::Active,
                'user_id' => $userId,
            ]);

            $this->upsert(SafaeiPhoto::class, [
                'safaei_id' => $safaei->id,
                'file_path' => "safaei/files/category-{$i}.pdf",
            ], []);
        }
    }
}
