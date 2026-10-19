<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('urban_service_categories', function (Blueprint $table) {
            $table->enum('lang', ['fa', 'ps', 'en', 'all'])->default('all')->after('name');
        });

        Schema::table('urban_services', function (Blueprint $table) {
            $table->enum('lang', ['fa', 'ps', 'en', 'all'])->default('all')->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('urban_services', function (Blueprint $table) {
            $table->dropColumn('lang');
        });

        Schema::table('urban_service_categories', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
    }
};
