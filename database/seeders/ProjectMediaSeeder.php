<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\Project;
use App\Models\ProjectMedia;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class ProjectMediaSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $projects = Project::query()->where('slug', 'like', 'project-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(ProjectMedia::class, [
                'project_id' => $projects["project-{$i}"],
                'file' => "projects/media/project-{$i}.pdf",
            ], [
                'type' => 'document',
                'title' => "سند پروژه {$i}",
                'sort_order' => $i,
                'status' => RecordStatus::Active,
                'user_id' => $userId,
            ]);
        }
    }
}
