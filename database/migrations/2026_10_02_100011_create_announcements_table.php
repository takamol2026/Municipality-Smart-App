<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_category_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('attachment')->nullable();
            $table->date('publish_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
