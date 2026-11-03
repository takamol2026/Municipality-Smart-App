<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_safaei AS
SELECT
    p.id,
    CASE
        WHEN p.file_path IS NULL OR p.file_path = '' THEN NULL
        ELSE SUBSTRING_INDEX(REPLACE(p.file_path, CHAR(92), '/'), '/', -1)
    END AS file_name,
    CASE WHEN p.file_path IS NULL OR p.file_path = '' THEN NULL WHEN p.file_path LIKE 'http://%' OR p.file_path LIKE 'https://%' THEN p.file_path ELSE CONCAT('storage/', TRIM(LEADING '/' FROM p.file_path)) END AS file_url,
    CASE
        WHEN LOWER(SUBSTRING_INDEX(p.file_path, '.', -1)) IN ('jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp') THEN 1
        ELSE 0
    END AS is_image,
    s.id AS safaei_id,
    s.title AS safaei_title,
    c.id AS category_id,
    c.name AS category_name,
    p.created_at
FROM safaei_photo p
INNER JOIN safaei s ON s.id = p.safaei_id AND s.deleted_at IS NULL
INNER JOIN safaei_category c ON c.id = s.safaei_category_id AND c.deleted_at IS NULL AND c.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_safaei');
    }
};
