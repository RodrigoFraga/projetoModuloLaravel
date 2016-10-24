<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ProjetoMenbroTransformer extends TransformerAbstract
{
    public function transform(User $menbro)
    {
        return [
            'menbro_id' => $menbro->id,
            'nome' => $menbro->name
        ];
    }
}