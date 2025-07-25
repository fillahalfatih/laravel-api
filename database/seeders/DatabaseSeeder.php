<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Customer::factory()
            ->count(25)
            ->hasInvoices(10)
            ->create();
        Customer::factory()
            ->count(100)
            ->hasInvoices(5)
            ->create();
        Customer::factory()
            ->count(100)
            ->hasInvoices(3)
            ->create();
        Customer::factory()
            ->count(5)
            ->create();
    }
}
