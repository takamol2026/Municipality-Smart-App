<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
CREATE OR REPLACE VIEW vw_announcements AS
SELECT
    a.id,
    a.title,
    a.lang,
    a.slug,
    a.short_description,
    a.content,
    CASE WHEN a.image IS NULL OR a.image = '' THEN NULL WHEN a.image LIKE 'http://%' OR a.image LIKE 'https://%' THEN a.image ELSE CONCAT('storage/', TRIM(LEADING '/' FROM a.image)) END AS image_url,
    CASE WHEN a.attachment IS NULL OR a.attachment = '' THEN NULL WHEN a.attachment LIKE 'http://%' OR a.attachment LIKE 'https://%' THEN a.attachment ELSE CONCAT('storage/', TRIM(LEADING '/' FROM a.attachment)) END AS attachment_url,
    a.publish_date,
    a.expire_date,
    a.status,
    a.sort_order,
    a.announcement_category_id AS category_id,
    c.name AS category_name,
    c.slug AS category_slug,
    a.created_at
FROM announcements a
LEFT JOIN announcement_categories c
    ON c.id = a.announcement_category_id
   AND c.deleted_at IS NULL
WHERE a.status = 'active'
  AND (a.publish_date IS NULL OR a.publish_date <= CURDATE())
  AND (a.expire_date IS NULL OR a.expire_date >= CURDATE())
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_announcements');
    }
};
