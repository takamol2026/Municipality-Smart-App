<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var list<string>
     */
    private array $tables = [
        'districts',
        'historical_attractions',
        'map_locations',
        'rentals',
        'complaints',
        'suggestions',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            $this->changeCoordinates($tableName, 11, 8);
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            $this->changeCoordinates($tableName, 10, 4);
        }
    }

    private function changeCoordinates(string $tableName, int $precision, int $scale): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($tableName, $precision, $scale) {
            if (Schema::hasColumn($tableName, 'latitude')) {
                $table->decimal('latitude', $precision, $scale)->nullable()->change();
            }

            if (Schema::hasColumn($tableName, 'longitude')) {
                $table->decimal('longitude', $precision, $scale)->nullable()->change();
            }
        });
    }
};
