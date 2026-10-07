<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\SafaeiCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class SafaeiCategorySeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(SafaeiCategory::class, ['name' => "دسته صفایی {$i}"], [
                'description' => "توضیحات دسته صفایی {$i}.",
                'status' => RecordStatus::Active,
                'user_id' => $userId,
            ]);
        }
    }
}
