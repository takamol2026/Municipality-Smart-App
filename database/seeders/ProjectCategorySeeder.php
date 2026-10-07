<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\ProjectCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(ProjectCategory::class, ['slug' => "project-category-{$i}"], [
                'name' => "دسته‌بندی پروژه {$i}",
                'description' => "توضیحات دسته‌بندی پروژه {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
