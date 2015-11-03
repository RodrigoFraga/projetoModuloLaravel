<?php

use Illuminate\Database\Seeder;
use projetoModuloLaravel\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// User::truncate();
        factory(projetoModuloLaravel\Entities\User::class)->create([
            'name' => 'Rodrigo Fraga',
            'email' => 'rodrigofraga6@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10)
        ]);

        factory(User::class, 10)->create();
    }
}
