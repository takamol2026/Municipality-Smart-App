<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_safaei_categories AS
SELECT
    c.id,
    c.name,
    c.lang,
    c.description,
    c.status,
    (
        SELECT COUNT(*)
        FROM safaei s
        WHERE s.safaei_category_id = c.id
          AND s.deleted_at IS NULL
    ) AS safaeis_count
FROM safaei_category c
WHERE c.status = 'active'
  AND c.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_safaei_categories');
    }
};
