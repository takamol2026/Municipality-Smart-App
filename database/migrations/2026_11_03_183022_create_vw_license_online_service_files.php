<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_license_online_service_files AS
SELECT
    f.id,
    f.license_online_service_id,
    f.file_name,
    f.file_type,
    f.file_size,
    CASE WHEN f.file_path IS NULL OR f.file_path = '' THEN NULL WHEN f.file_path LIKE 'http://%' OR f.file_path LIKE 'https://%' THEN f.file_path ELSE CONCAT('storage/', TRIM(LEADING '/' FROM f.file_path)) END AS url,
    f.created_at
FROM license_online_service_files f
INNER JOIN license_online_services s ON s.id = f.license_online_service_id
WHERE f.deleted_at IS NULL
  AND s.deleted_at IS NULL
  AND s.status = 'active'
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_license_online_service_files');
    }
};
