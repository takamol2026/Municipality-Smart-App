<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\RecordStatus;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = AnnouncementCategory::query()->where('slug', 'like', 'announcement-category-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(Announcement::class, ['slug' => "announcement-{$i}"], [
                'announcement_category_id' => $categories["announcement-category-{$i}"],
                'title' => "اطلاعیه {$i}",
                'lang' => Language::All,
                'short_description' => "خلاصه اطلاعیه {$i}.",
                'content' => "متن اطلاعیه شماره {$i} از شاروالی هرات.",
                'publish_date' => now()->subDays($i)->toDateString(),
                'expire_date' => now()->addDays(30 + $i)->toDateString(),
                'status' => RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
