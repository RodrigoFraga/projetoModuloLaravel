<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Presenters\ProjetoMenbroPresenter;
use projetoModuloLaravel\Repositories\ProjetoMenbroRepository;
use projetoModuloLaravel\Entities\ProjetoMenbro;

/**
 * Class ProjetoMenbroRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class ProjetoMenbroRepositoryEloquent extends BaseRepository implements ProjetoMenbroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjetoMenbro::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return ProjetoMenbroPresenter::class;
    }
}
