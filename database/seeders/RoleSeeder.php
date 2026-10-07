<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\Role;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(Role::class, ['slug' => "role-{$i}"], [
                'name' => "نقش {$i}",
                'status' => RecordStatus::Active,
            ]);
        }
    }
}
