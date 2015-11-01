<?php

use Illuminate\Database\Seeder;
use projetoModuloLaravel\Entities\Cliente;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Cliente::truncate();
        factory(Cliente::class, 10)->create();
    }
}
