<?php

namespace Database\Seeders;

use App\Models\Safaei;
use App\Models\SafaeiCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class SafaeiSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $categories = SafaeiCategory::query()->where('name', 'like', 'دسته صفایی %')->pluck('id', 'name');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(Safaei::class, [
                'safaei_category_id' => $categories["دسته صفایی {$i}"],
                'file_path' => "safaei/files/category-{$i}.pdf",
            ], []);
        }
    }
}
