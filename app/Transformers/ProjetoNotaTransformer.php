<?php

namespace projetoModuloLaravel\Transformers;

use projetoModuloLaravel\Entities\ProjetoNota;
use League\Fractal\TransformerAbstract;

/**
* 
*/
class ProjetoNotaTransformer extends TransformerAbstract
{
	public function transform(ProjetoNota $projetoNota)
	{
		return [
			'id'	=> $projetoNota->id,
			'projeto_id'	=> $projetoNota->projeto_id,
			'titulo'	=> $projetoNota->titulo,
			'conteudo'	=> $projetoNota->conteudo
		];
	}
}