<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_map_locations AS
SELECT
    l.id,
    l.name,
    l.lang,
    l.slug,
    l.description,
    l.address,
    l.latitude,
    l.longitude,
    l.phone,
    CASE WHEN l.image IS NULL OR l.image = '' THEN NULL WHEN l.image LIKE 'http://%' OR l.image LIKE 'https://%' THEN l.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM l.image)) END AS image_url,
    l.status,
    l.sort_order,
    l.map_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    l.created_at
FROM map_locations l
LEFT JOIN map_categories c
    ON c.id = l.map_category_id
   AND c.deleted_at IS NULL
WHERE l.status = 'active'
  AND l.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_map_locations');
    }
};
