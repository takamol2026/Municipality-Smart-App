<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_map_categories AS
SELECT
    c.id,
    c.name,
    c.lang,
    c.slug,
    c.description,
    CASE WHEN c.img IS NULL OR c.img = '' THEN NULL WHEN c.img LIKE 'http://%' OR c.img LIKE 'https://%' THEN c.img ELSE CONCAT('storage/', TRIM(LEADING '/' FROM c.img)) END AS image_url,
    c.status,
    c.sort_order,
    (
        SELECT COUNT(*)
        FROM map_locations l
        WHERE l.map_category_id = c.id
          AND l.status = 'active'
          AND l.deleted_at IS NULL
    ) AS locations_count
FROM map_categories c
WHERE c.status = 'active'
  AND c.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_map_categories');
    }
};
