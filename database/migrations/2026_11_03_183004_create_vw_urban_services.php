<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_urban_services AS
SELECT
    s.id,
    s.name,
    s.lang,
    s.slug,
    s.short_description,
    s.description,
    s.status,
    s.sort_order,
    s.urban_service_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    s.created_at
FROM urban_services s
LEFT JOIN urban_service_categories c
    ON c.id = s.urban_service_category_id
   AND c.deleted_at IS NULL
WHERE s.status = 'active'
  AND s.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_urban_services');
    }
};
