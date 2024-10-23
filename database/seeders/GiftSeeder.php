<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GiftSeeder extends Seeder
{
    public function run()
    {
        DB::table('gifts')->insert([
            ['nome' => 'Livro'],
            ['nome' => 'Roupas'],
            ['nome' => 'Eletrônicos'],
            ['nome' => 'Viagem'],
            ['nome' => 'Jogos'],
            ['nome' => 'Joias'],
            ['nome' => 'Artesanato'],
            ['nome' => 'Doces'],
            ['nome' => 'Decoração'],
            ['nome' => 'Produtos de Beleza']
        ]);
    }
}
