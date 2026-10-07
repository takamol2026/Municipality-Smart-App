<?php

namespace Database\Seeders;

use App\Models\MapLocation;
use App\Models\MapMedia;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class MapMediaSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $locations = MapLocation::query()->where('slug', 'like', 'map-location-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $this->upsert(MapMedia::class, [
                'map_location_id' => $locations["map-location-{$i}"],
                'location' => "map/media/location-{$i}.pdf",
            ], [
                'type' => 'document',
                'user_id' => $userId,
            ]);
        }
    }
}
