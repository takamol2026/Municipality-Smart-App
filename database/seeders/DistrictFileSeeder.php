<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\DistrictFile;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class DistrictFileSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $districts = District::query()->where('slug', 'like', 'district-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $location = "districts/files/district-{$i}.pdf";

            $this->upsert(DistrictFile::class, [
                'district_id' => $districts["district-{$i}"],
                'location' => $location,
            ], []);
        }
    }
}
