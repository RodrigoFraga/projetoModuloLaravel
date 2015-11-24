<?php

use Illuminate\Database\Seeder;
use projetoModuloLaravel\Entities\ProjetoTask;

class ProjetoTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// ProjetoNota::truncate();
        factory(ProjetoTask::class, 50)->create();
    }
}
