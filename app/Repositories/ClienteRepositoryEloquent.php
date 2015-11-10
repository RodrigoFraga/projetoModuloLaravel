<?php

namespace projetoModuloLaravel\Repositories;

use projetoModuloLaravel\Entities\Cliente;
use projetoModuloLaravel\Repositories\ClienteRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use projetoModuloLaravel\Presenters\ClientePresenter;



class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
	
	public function model()
	{
		return Cliente::class;
	}

	public function presenter()
    {
        return ClientePresenter::class;
    }
}