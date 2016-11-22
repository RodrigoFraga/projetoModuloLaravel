<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Presenters\ProjetoTaskPresenter;
use projetoModuloLaravel\Repositories\ProjetoTaskRepository;
use projetoModuloLaravel\Entities\ProjetoTask;

/**
 * Class ProjetoTaskRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class ProjetoTaskRepositoryEloquent extends BaseRepository implements ProjetoTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjetoTask::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjetoTaskPresenter::class;
    }
}
