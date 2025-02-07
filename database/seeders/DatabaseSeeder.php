<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::query()->firstOrCreate(['name' => 'admin']);
        Role::query()->firstOrCreate(['name' => 'guest']);

        $adminUser = User::query()->where('email', 'admin@admin.local')->first();

        if (!$adminUser) {
            $adminUser = User::query()->create([
                'name' => 'Admin User',
                'email' => 'admin@admin.local',
                'password' => Hash::make('password'),
            ]);
        }

        $adminUser->assignRole('admin');
    }
}
