<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name' => 'Toko Salim',
            'user_id' => 2,
        ]);

        Group::create([
            'name' => 'Toko Fathin',
            'user_id' => 3,
        ]);
    }
}
