<?php

namespace projetoModuloLaravel\Transformers;

use League\Fractal\TransformerAbstract;
use projetoModuloLaravel\Entities\Teste;

/**
 * Class TesteTransformer
 * @package namespace projetoModuloLaravel\Transformers;
 */
class TesteTransformer extends TransformerAbstract
{

    /**
     * Transform the \Teste entity
     * @param \Teste $model
     *
     * @return array
     */
    public function transform(Teste $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
