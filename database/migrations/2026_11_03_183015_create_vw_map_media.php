<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_map_media AS
SELECT
    m.id,
    m.map_location_id,
    m.type,
    CASE WHEN m.location IS NULL OR m.location = '' THEN NULL WHEN m.location LIKE 'http://%' OR m.location LIKE 'https://%' THEN m.location ELSE CONCAT('storage/', TRIM(LEADING '/' FROM m.location)) END AS url,
    m.created_at
FROM map_media m
INNER JOIN map_locations l ON l.id = m.map_location_id
WHERE m.deleted_at IS NULL
  AND l.deleted_at IS NULL
  AND l.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_map_media');
    }
};
