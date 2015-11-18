<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\Projeto;
use League\Fractal\TransformerAbstract;

/**
* 
*/
class ProjetoTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['menbro'];

	public function transform(Projeto $projeto)
	{
		return [
			'id' => $projeto->id,
			'cliente_id' => $projeto->cliente_id,
			'owner_id' => $projeto->owner_id,
			'nome' => $projeto->nome,
			'descricao' => $projeto->descricao,
			'progresso' => (int) $projeto->progresso,
			'status' => $projeto->status,
			'due_date' => $projeto->due_date,
			'cliente' => $projeto->cliente
		];
	}

	public function includeMenbro(Projeto $projeto)
	{
		return $this->collection($projeto->menbros, new ProjetoMenbroTransformer());
	}
	// public function includeCliente(Projeto $projeto)
	// {
	// 	return $this->collection($projeto->cliente, new ClienteTransformer());
	// }
}