<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Models\User;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $username = $i === 1 ? 'admin' : "user-{$i}";
            $email = $i === 1 ? 'admin@herat.local' : "user-{$i}@herat.local";
            $name = $i === 1 ? 'احمد' : 'کاربر';
            $lastName = $i === 1 ? 'احمدی' : (string) $i;

            $this->seedUser($username, $email, $name, $lastName, '070'.str_pad((string) $i, 7, '0', STR_PAD_LEFT));
        }
    }

    private function seedUser(string $username, string $email, string $name, string $lastName, string $phone): void
    {
        $user = User::query()->firstOrNew(['username' => $username]);

        $user->fill([
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'status' => RecordStatus::Active,
        ]);
        $user->email_verified_at = now();

        if (! $user->exists) {
            $user->password = 'password';
        }

        $user->save();
    }
}
