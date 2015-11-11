<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\Cliente;
use League\Fractal\TransformerAbstract;

/**
* 
*/
class ClienteTransformer extends TransformerAbstract
{
	public function transform(Cliente $cliente)
	{
		return [
			'id'	=> $cliente->id,
			'nome'	=> $cliente->nome,
			'responsavel'	=> $cliente->responsavel,
			'email'	=> $cliente->email,
			'telefone'	=> $cliente->telefone,
			'end'	=> $cliente->end,
			'obs'	=> $cliente->obs
		];
	}
}