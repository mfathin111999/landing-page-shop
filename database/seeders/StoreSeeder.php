<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => 'Toko Salim',
            'group_id' => 1,
        ]);

        Store::create([
            'name' => 'Toko Fathin',
            'group_id' => 2,
        ]);
    }
}
