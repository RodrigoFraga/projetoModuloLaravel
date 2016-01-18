<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Repositories\OauthClientesRepository;
use projetoModuloLaravel\Entities\OauthClientes;

/**
 * Class OauthClientesRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class OauthClientesRepositoryEloquent extends BaseRepository implements OauthClientesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OauthClientes::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
