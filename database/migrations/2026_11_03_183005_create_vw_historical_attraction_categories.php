<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_historical_attraction_categories AS
SELECT
    c.id,
    c.name,
    c.lang,
    c.slug,
    c.description,
    CASE WHEN c.image IS NULL OR c.image = '' THEN NULL WHEN c.image LIKE 'http://%' OR c.image LIKE 'https://%' THEN c.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM c.image)) END AS image_url,
    c.status,
    c.sort_order,
    (
        SELECT COUNT(*)
        FROM historical_attractions a
        WHERE a.historical_attraction_category_id = c.id
          AND a.status = 'active'
          AND a.deleted_at IS NULL
    ) AS attractions_count
FROM historical_attraction_categories c
WHERE c.status = 'active'
  AND c.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_historical_attraction_categories');
    }
};
