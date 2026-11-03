<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_project_media AS
SELECT
    m.id,
    m.project_id,
    m.type,
    m.title,
    CASE WHEN m.file IS NULL OR m.file = '' THEN NULL WHEN m.file LIKE 'http://%' OR m.file LIKE 'https://%' THEN m.file ELSE CONCAT('storage/', TRIM(LEADING '/' FROM m.file)) END AS file_url,
    CASE
        WHEN m.thumbnail IS NOT NULL AND m.thumbnail <> '' THEN CASE WHEN m.thumbnail IS NULL OR m.thumbnail = '' THEN NULL WHEN m.thumbnail LIKE 'http://%' OR m.thumbnail LIKE 'https://%' THEN m.thumbnail ELSE CONCAT('storage/', TRIM(LEADING '/' FROM m.thumbnail)) END
        WHEN m.type = 'image' OR LOWER(SUBSTRING_INDEX(m.file, '.', -1)) IN ('jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp') THEN CASE WHEN m.file IS NULL OR m.file = '' THEN NULL WHEN m.file LIKE 'http://%' OR m.file LIKE 'https://%' THEN m.file ELSE CONCAT('storage/', TRIM(LEADING '/' FROM m.file)) END
        ELSE NULL
    END AS thumbnail_url,
    m.sort_order,
    m.created_at
FROM project_media m
INNER JOIN projects p ON p.id = m.project_id
WHERE m.status = 'active'
  AND p.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_project_media');
    }
};
