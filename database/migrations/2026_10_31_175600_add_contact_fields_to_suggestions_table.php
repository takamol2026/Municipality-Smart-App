<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
            $table->decimal('latitude', 10, 4)->nullable()->after('image');
            $table->decimal('longitude', 10, 4)->nullable()->after('latitude');
            $table->string('full_name')->nullable()->after('longitude');
            $table->string('phone', 20)->nullable()->after('full_name');
            $table->foreignId('district_id')->nullable()->after('phone')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('district_id');
            $table->dropColumn(['image', 'latitude', 'longitude', 'full_name', 'phone']);
        });
    }
};
