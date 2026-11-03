<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_projects AS
SELECT
    p.id,
    p.title,
    p.slug,
    p.short_description,
    p.description,
    p.location,
    p.benefits,
    p.start_date,
    p.end_date,
    CASE WHEN p.image IS NULL OR p.image = '' THEN NULL WHEN p.image LIKE 'http://%' OR p.image LIKE 'https://%' THEN p.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM p.image)) END AS image_url,
    p.status,
    p.status_publish,
    p.sort_order,
    p.project_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    p.created_at
FROM projects p
LEFT JOIN project_categories c
    ON c.id = p.project_category_id
   AND c.deleted_at IS NULL
WHERE p.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_projects');
    }
};
