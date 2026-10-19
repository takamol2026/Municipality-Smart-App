<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('historical_attractions', 'location')) {
            return;
        }

        Schema::table('historical_attractions', function (Blueprint $table) {
            $table->string('location')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('historical_attractions', 'location')) {
            return;
        }

        Schema::table('historical_attractions', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};
