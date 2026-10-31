<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('historical_attractions', function (Blueprint $table) {
            $table->decimal('latitude', 10, 4)->nullable()->after('location');
            $table->decimal('longitude', 10, 4)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('historical_attractions', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
