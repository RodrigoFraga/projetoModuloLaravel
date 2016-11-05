<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Presenters\ProjetoFilePresenter;
use projetoModuloLaravel\Entities\ProjetoFile;

/**
 * Class ProjetoFileRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class ProjetoFileRepositoryEloquent extends BaseRepository implements ProjetoFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjetoFile::class;
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
        return ProjetoFilePresenter::class;
    }
}
