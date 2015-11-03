<?php

use Illuminate\Database\Seeder;
use projetoModuloLaravel\Entities\ProjetoNota;

class ProjetoNotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// ProjetoNota::truncate();
        factory(ProjetoNota::class, 50)->create();
    }
}
