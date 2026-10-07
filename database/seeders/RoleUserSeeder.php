<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $roles = Role::query()->where('slug', 'like', 'role-%')->pluck('id', 'slug');

        for ($i = 1; $i <= $this->seedCount(); $i++) {
            $username = $i === 1 ? 'admin' : "user-{$i}";
            $userId = User::query()->where('username', $username)->value('id');

            $this->upsert(RoleUser::class, [
                'role_id' => $roles["role-{$i}"],
                'user_id' => $userId,
            ], []);
        }
    }
}
