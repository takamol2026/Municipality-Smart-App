<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\District;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(District::class, ['slug' => "district-{$i}"], [
                'name' => "ناحیه {$i} هرات",
                'lang' => Language::All,
                'number' => (string) $i,
                'description' => "اطلاعات ناحیه {$i} شهر هرات.",
                'address' => "آدرس ناحیه {$i}، شهر هرات",
                'phone' => '040'.str_pad((string) $i, 7, '0', STR_PAD_LEFT),
                'email' => "district-{$i}@herat.local",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
