<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_districts AS
SELECT
    d.id,
    d.name,
    d.lang,
    d.number,
    d.slug,
    d.description,
    d.address,
    d.latitude,
    d.longitude,
    d.phone,
    d.email,
    CASE WHEN d.image IS NULL OR d.image = '' THEN NULL WHEN d.image LIKE 'http://%' OR d.image LIKE 'https://%' THEN d.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM d.image)) END AS image_url,
    d.status,
    d.sort_order,
    d.created_at
FROM districts d
WHERE d.status = 'active'
  AND d.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_districts');
    }
};
