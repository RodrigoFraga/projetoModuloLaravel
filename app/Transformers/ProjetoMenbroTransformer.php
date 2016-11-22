<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\ProjetoMenbro;
use projetoModuloLaravel\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ProjetoMenbroTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    public function transform(ProjetoMenbro $menbro)
    {
        return [
            'id' => $menbro->id,
            'projeto_id' => $menbro->projeto_id,
        ];
    }

    public function includeUser(ProjetoMenbro $model)
    {
        return $this->item($model->menbro, new MenbroTransformer());
    }
}