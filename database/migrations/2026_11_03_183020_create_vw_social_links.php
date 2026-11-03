<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_social_links AS
SELECT
    s.id,
    s.network,
    s.url,
    s.status,
    s.sort_order,
    s.created_at
FROM social_links s
WHERE s.status = 'active'
  AND s.deleted_at IS NULL
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_social_links');
    }
};
