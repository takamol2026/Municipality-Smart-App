<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_historical_attractions AS
SELECT
    a.id,
    a.name,
    a.lang,
    a.slug,
    a.short_description,
    a.description,
    a.history,
    a.address,
    a.location,
    a.latitude,
    a.longitude,
    CASE WHEN a.image IS NULL OR a.image = '' THEN NULL WHEN a.image LIKE 'http://%' OR a.image LIKE 'https://%' THEN a.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM a.image)) END AS image_url,
    a.status,
    a.sort_order,
    a.historical_attraction_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    a.created_at
FROM historical_attractions a
LEFT JOIN historical_attraction_categories c
    ON c.id = a.historical_attraction_category_id
   AND c.deleted_at IS NULL
WHERE a.status = 'active'
  AND a.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_historical_attractions');
    }
};
