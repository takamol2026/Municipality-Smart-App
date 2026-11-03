<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_district_files AS
SELECT
    f.id,
    f.district_id,
    CASE WHEN f.location IS NULL OR f.location = '' THEN NULL WHEN f.location LIKE 'http://%' OR f.location LIKE 'https://%' THEN f.location ELSE CONCAT('storage/', TRIM(LEADING '/' FROM f.location)) END AS url,
    f.created_at
FROM districts_files f
INNER JOIN districts d ON d.id = f.district_id
WHERE f.deleted_at IS NULL
  AND d.deleted_at IS NULL
  AND d.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_district_files');
    }
};
