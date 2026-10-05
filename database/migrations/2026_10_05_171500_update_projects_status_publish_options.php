<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('projects')) {
            return;
        }

        DB::statement("ALTER TABLE projects MODIFY COLUMN status_publish ENUM('draft', 'published', 'in_progress', 'completed', 'not_started') NOT NULL DEFAULT 'draft'");
        DB::table('projects')->where('status_publish', 'draft')->update(['status_publish' => 'not_started']);
        DB::table('projects')->where('status_publish', 'published')->update(['status_publish' => 'completed']);
        DB::statement("ALTER TABLE projects MODIFY COLUMN status_publish ENUM('in_progress', 'completed', 'not_started') NOT NULL DEFAULT 'not_started'");
    }

    public function down(): void
    {
        if (! Schema::hasTable('projects')) {
            return;
        }

        DB::statement("ALTER TABLE projects MODIFY COLUMN status_publish ENUM('in_progress', 'completed', 'not_started', 'draft', 'published') NOT NULL DEFAULT 'not_started'");
        DB::table('projects')->where('status_publish', 'not_started')->update(['status_publish' => 'draft']);
        DB::table('projects')->whereIn('status_publish', ['completed', 'in_progress'])->update(['status_publish' => 'published']);
        DB::statement("ALTER TABLE projects MODIFY COLUMN status_publish ENUM('draft', 'published') NOT NULL DEFAULT 'draft'");
    }
};
