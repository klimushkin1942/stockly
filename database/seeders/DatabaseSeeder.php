<?php

namespace Database\Seeders;

use App\Enums\Role\RoleEnum;
use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12344321),
        ];

        $user = User::firstOrCreate([
            'email' => $user['email'],
        ], $user);

        $role = Role::firstOrCreate([
            'title' => RoleEnum::ADMIN
        ]);

        $user->roles()->sync($role->id);
    }
}
