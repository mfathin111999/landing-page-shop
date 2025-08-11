<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Superadmimn',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
        ]);
        $admin->assignRole('superadmin');

        $toko = User::create([
            'name' => 'Salim',
            'username' => 'Salim',
            'email' => 'salim@gmail.com',
            'password' => bcrypt('rahasia123'),
        ]);
        $toko->assignRole('owner');

        $toko_1 = User::create([
            'name' => 'Fathin',
            'username' => 'fathin',
            'email' => 'fathin@gmail.com',
            'password' => bcrypt('ghobed123'),
        ]);
        $toko_1->assignRole('owner');

    }
}
