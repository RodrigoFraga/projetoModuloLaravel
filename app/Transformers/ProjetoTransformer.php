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
			'projeto_id' => $projeto->id,
			'cliente_id' => $projeto->cliente_id,
			'owner_id' => $projeto->owner_id,
			'nome' => $projeto->nome,
			'descreicao' => $projeto->descricao,
			'progresso' => $projeto->progresso,
			'status' => $projeto->status,
			'due_date' => $projeto->due_date
		];
	}

	public function includeMenbro(Projeto $projeto)
	{
		return $this->collection($projeto->menbros, new ProjetoMenbroTransformer());
	}
}