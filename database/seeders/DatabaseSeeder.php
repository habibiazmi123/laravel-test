<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)
            ->state([
                'role' => UserRole::ADMINISTRATOR,
                'active' => true
            ])
            ->create();

        User::factory(5)
            ->has(Order::factory(3))
            ->create();
    }
}
