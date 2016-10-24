<?php

namespace projetoModuloLaravel\Transformers;

use League\Fractal\TransformerAbstract;
use projetoModuloLaravel\Entities\ProjetoFile;

/**
 * Class ProjetoFileTransformer
 * @package namespace projetoModuloLaravel\Transformers;
 */
class ProjetoFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjetoFile entity
     * @param \ProjetoFile $model
     *
     * @return array
     */
    public function transform(ProjetoFile $model)
    {
        return [
            'id' => (int)$model->id,
            'projeto_id' => $model->projeto_id,
            'nome' => $model->nome,
            'descricao' => $model->descricao,
            'extensao' => $model->extensao,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
