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

    public function findOrFail($id)
    {
        return Projeto::findOrFail($id);
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
        if (count($this->skipPresenter()->findWhere(['id' => $projetoId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }

    public function hasMenbro($projetoId, $userId)
    {
        $projeto = $this->skipPresenter()->find($projetoId);

        foreach ($projeto->menbros as $menbro) {
            if ($menbro->id == $userId) return true;
        }
        return false;
    }

    public function findOwner($userId, $limit = null, $columns = array())
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projetos.*')->where('owner_id', '=', $userId);
        })->paginate($limit, $columns);
    }

    public function findMenber($userId, $limit = null, $columns = array())
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projetos.*')
                ->leftJoin('projeto_menbros', 'projeto_menbros.projeto_id', '=', 'projetos.id')
                ->where('projeto_menbros.menbro_id', '=', $userId);
        })->paginate($limit, $columns);
    }

    public function findWithMenber($userId, $limit = null, $columns = array())
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('projetos.*')
                ->leftJoin('projeto_menbros', 'projeto_menbros.projeto_id', '=', 'projetos.id')
                ->where('projeto_menbros.menbro_id', '=', $userId);
        })->paginate($limit, $columns);
    }

    public function presenter()
    {
        return ProjetoPresenter::class;
    }
}
