<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_rentals AS
SELECT
    r.id,
    r.name,
    r.lang,
    r.slug,
    r.description,
    r.address,
    r.latitude,
    r.longitude,
    r.rental_price,
    r.rental_period,
    CASE WHEN r.image IS NULL OR r.image = '' THEN NULL WHEN r.image LIKE 'http://%' OR r.image LIKE 'https://%' THEN r.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM r.image)) END AS image_url,
    r.status,
    r.sort_order,
    r.rental_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    r.created_at
FROM rentals r
LEFT JOIN rental_categories c
    ON c.id = r.rental_category_id
   AND c.deleted_at IS NULL
WHERE r.status = 'active'
  AND r.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_rentals');
    }
};
