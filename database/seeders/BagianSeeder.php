<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bagian;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Bagian::create(['nama_bagian' => 'PPh']);
        Bagian::create(['nama_bagian' => 'PPN']);
        Bagian::create(['nama_bagian' => 'Bea Materai']);
    }
}
