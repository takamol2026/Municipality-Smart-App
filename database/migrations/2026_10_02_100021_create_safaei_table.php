<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('safaei', function (Blueprint $table) {
            $table->id();
            $table->foreignId('safaei_category_id')->constrained('safaei_category')->restrictOnDelete();
            $table->string('title');
            $table->enum('lang', ['fa', 'ps', 'en', 'all'])->default('all');
            $table->mediumText('description')->nullable();
            $table->string('annual_fee', 45)->nullable();
            $table->string('payment_condition', 45)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('safaei');
    }
};
