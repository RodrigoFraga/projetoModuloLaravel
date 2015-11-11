<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Repositories\TesteRepository;
use projetoModuloLaravel\Entities\Teste;

/**
 * Class TesteRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class TesteRepositoryEloquent extends BaseRepository implements TesteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Teste::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
