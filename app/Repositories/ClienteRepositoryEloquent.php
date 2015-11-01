<?php

namespace projetoModuloLaravel\Repositories;

use projetoModuloLaravel\Entities\Cliente;
use projetoModuloLaravel\Repositories\ClienteRepository;
use Prettus\Repository\Eloquent\BaseRepository;


class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
	
	public function model()
	{
		return Cliente::class;
	}
}