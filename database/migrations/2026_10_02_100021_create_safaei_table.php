<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * The Workbench script defined `safaei` twice with the same columns and a
     * required self-reference. This table stores the file and belongs to a category.
     */
    public function up(): void
    {
        Schema::create('safaei', function (Blueprint $table) {
            $table->id();
            $table->string('file_path')->nullable();
            $table->foreignId('safaei_category_id')->constrained('safaei_category')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safaei');
    }
};
