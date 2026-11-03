<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_scholars AS
SELECT
    s.id,
    s.name,
    s.lang,
    s.slug,
    s.short_bio,
    s.biography,
    s.birth_date,
    s.death_date,
    s.education,
    s.works,
    CASE WHEN s.image IS NULL OR s.image = '' THEN NULL WHEN s.image LIKE 'http://%' OR s.image LIKE 'https://%' THEN s.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM s.image)) END AS image_url,
    s.status,
    s.sort_order,
    s.created_at
FROM scholars s
WHERE s.status = 'active'
  AND s.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_scholars');
    }
};
