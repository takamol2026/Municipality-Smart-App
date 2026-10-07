<?php

namespace Database\Seeders;

use App\Enums\PublishStatus;
use App\Enums\RecordStatus;
use App\Models\Project;
use App\Models\ProjectCategory;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $categories = ProjectCategory::query()->where('slug', 'like', 'project-category-%')->pluck('id', 'slug');
        $statuses = [
            PublishStatus::InProgress,
            PublishStatus::Completed,
            PublishStatus::NotStarted,
        ];

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(Project::class, ['slug' => "project-{$i}"], [
                'project_category_id' => $categories["project-category-{$i}"],
                'title' => "پروژه {$i}",
                'short_description' => "خلاصه پروژه {$i}.",
                'description' => "شرح پروژه شماره {$i} در شاروالی هرات.",
                'status' => RecordStatus::Active,
                'location' => "موقعیت پروژه {$i}، هرات",
                'benefits' => "دستاوردهای پروژه {$i}.",
                'start_date' => now()->subDays($i)->toDateString(),
                'end_date' => now()->addDays($i)->toDateString(),
                'status_publish' => $statuses[$i % 3],
                'sort_order' => $i,
                'user_id' => $userId,
            ]);
        }
    }
}
