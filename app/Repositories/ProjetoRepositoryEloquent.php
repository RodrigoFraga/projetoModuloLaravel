<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use projetoModuloLaravel\Presenters\ProjetoPresenter;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Entities\Projeto;

/**
 * Class ProjetoRepositoryEloquent
 * @package namespace projetoModuloLaravel\Repositories;
 */
class ProjetoRepositoryEloquent extends BaseRepository implements ProjetoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projeto::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projetoId, $userId)
    {
        if(count($this->findWhere(['id' => $projetoId, 'owner_id' => $userId]))){
            return true;
        }
        return false;
    }

    public function hasMenbro($projetoId, $userId)
    {
        $projeto = $this->find($projetoId);

        foreach ($projeto->menbros as $menbro) {
            if($menbro->id == $userId) return true;
        }
        return false;
    }

    public function presenter()
    {
        return ProjetoPresenter::class;
    }
}
