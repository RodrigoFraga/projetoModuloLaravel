<?php

namespace projetoModuloLaravel\Repositories;

use projetoModuloLaravel\Entities\Cliente;
use projetoModuloLaravel\Repositories\ClienteRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Presenters\ClientePresenter;


class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
    protected $fieldSearchable = [
        'nome'
    ];

    public function model()
    {
        return Cliente::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ClientePresenter::class;
    }
}