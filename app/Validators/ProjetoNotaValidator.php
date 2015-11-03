<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjetoNotaValidator extends LaravelValidator
{
	
	protected $rules = [
		'projeto_id'	=> 'required|integer',
		'titulo'	=> 'required',
		'conteudo'	=> 'required'
	];
}