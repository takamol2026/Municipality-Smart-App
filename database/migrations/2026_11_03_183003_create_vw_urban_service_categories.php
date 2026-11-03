<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_urban_service_categories AS
SELECT
    c.id,
    c.name,
    c.lang,
    c.slug,
    c.description,
    c.status,
    c.sort_order,
    (
        SELECT COUNT(*)
        FROM urban_services s
        WHERE s.urban_service_category_id = c.id
          AND s.status = 'active'
          AND s.deleted_at IS NULL
    ) AS services_count
FROM urban_service_categories c
WHERE c.status = 'active'
  AND c.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_urban_service_categories');
    }
};
