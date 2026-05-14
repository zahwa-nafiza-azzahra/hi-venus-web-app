<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name'     => 'Admin Hi Venus',
            'email'    => 'admin@hi-venus.test',
            'password' => 'password',
            'role'     => 'admin',
            'phone'    => '08123456789',
        ]);
        User::create([
            'name'     => 'Customer Venus',
            'email'    => 'user@hi-venus.test',
            'password' => 'password',
            'role'     => 'user',
            'phone'    => '08987654321',
        ]);

        User::create([
            'name'     => 'Kasir Hi Venus',
            'email'    => 'kasir@hi-venus.test',
            'password' => 'password',
            'role'     => 'cashier',
            'phone'    => '081222333444',
        ]);
    }
}
