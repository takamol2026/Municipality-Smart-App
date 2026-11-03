<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_announcement_categories AS
SELECT
    c.id,
    c.name,
    c.lang,
    c.slug,
    c.status,
    c.sort_order,
    (
        SELECT COUNT(*)
        FROM announcements a
        WHERE a.announcement_category_id = c.id
          AND a.status = 'active'
    ) AS announcements_count
FROM announcement_categories c
WHERE c.status = 'active'
  AND c.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_announcement_categories');
    }
};
