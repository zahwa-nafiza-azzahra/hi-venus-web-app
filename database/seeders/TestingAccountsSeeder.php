<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TestingAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $password = Hash::make('password');

        // Create 7 Cashier Accounts
        $this->command->info('Creating 7 Cashier accounts...');
        for ($i = 1; $i <= 7; $i++) {
            User::updateOrCreate(
                ['email' => "kasir{$i}@hi-venus.test"],
                [
                    'name' => "Kasir " . $faker->firstName . " " . $faker->lastName,
                    'password' => $password,
                    'role' => User::ROLE_CASHIER,
                    'phone' => '0812' . $faker->numerify('########'),
                    'venus_points' => 0,
                ]
            );
        }

        // Create 20 User Accounts
        $this->command->info('Creating 20 User accounts...');
        for ($i = 1; $i <= 20; $i++) {
            User::updateOrCreate(
                ['email' => "user{$i}@hi-venus.test"],
                [
                    'name' => $faker->name,
                    'password' => $password,
                    'role' => User::ROLE_USER,
                    'phone' => '0896' . $faker->numerify('########'),
                    'venus_points' => $faker->numberBetween(0, 5000),
                ]
            );
        }

        $this->command->info('Testing accounts created successfully! Password for all: "password"');
    }
}
