<?php

namespace projetoModuloLaravel\Transformers;

use League\Fractal\TransformerAbstract;
use projetoModuloLaravel\Entities\ProjetoTask;

/**
 * Class ProjetoTaskTransformer
 * @package namespace projetoModuloLaravel\Transformers;
 */
class ProjetoTaskTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjetoTask entity
     * @param \ProjetoTask $model
     *
     * @return array
     */
    public function transform(ProjetoTask $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
