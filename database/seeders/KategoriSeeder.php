<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Teh'
        ]);

        Kategori::create([
            'nama' => 'Padi'
        ]);

        Kategori::create([
            'nama' => 'Ubi'
        ]);

        Kategori::create([
            'nama' => 'Kopi'
        ]);
    }
}