<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Repositories\ProjetoNotaRepository;
use projetoModuloLaravel\Entities\ProjetoNota;
use projetoModuloLaravel\Presenters\ProjetoNotaPresenter;


/**
 * Class ProjetoNotaRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class ProjetoNotaRepositoryEloquent extends BaseRepository implements ProjetoNotaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjetoNota::class;
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
        return ProjetoNotaPresenter::class;
    }
}
