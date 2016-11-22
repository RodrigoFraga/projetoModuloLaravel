<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\Cliente;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ClienteTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['projetos'];

    public function transform(Cliente $cliente)
    {
        return [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'responsavel' => $cliente->responsavel,
            'email' => $cliente->email,
            'telefone' => $cliente->telefone,
            'end' => $cliente->end,
            'obs' => $cliente->obs
        ];
    }

    public function includeProjetos(Cliente $model)
    {
        $transformer = new ProjetoTransformer();
        $transformer->setDefaultIncludes([]);
        return $this->collection($model->projetos, $transformer);
    }
}