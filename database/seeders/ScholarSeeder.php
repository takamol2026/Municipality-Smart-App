<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\Scholar;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class ScholarSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $birthYear = 1850 + (($i - 1) % 100);

            $this->upsert(Scholar::class, ['slug' => "scholar-{$i}"], [
                'name' => "عالم {$i}",
                'lang' => Language::All,
                'short_bio' => "معرفی کوتاه عالم {$i}.",
                'biography' => "زندگی‌نامه عالم شماره {$i} از هرات.",
                'birth_date' => "{$birthYear}-01-01",
                'death_date' => ($birthYear + 70).'-01-01',
                'education' => "تحصیلات عالم {$i}.",
                'works' => "آثار عالم {$i}.",
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
