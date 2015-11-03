<?php

use Illuminate\Database\Seeder;
use projetoModuloLaravel\Entities\Projeto;

class ProjetoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Projeto::truncate();
        factory(Projeto::class, 10)->create();
    }
}
