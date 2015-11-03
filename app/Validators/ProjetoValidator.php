<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjetoValidator extends LaravelValidator
{
	
	protected $rules = [
		'owner_id'	=> 'required|integer',
		'cliente_id'	=> 'required|integer',
		'nome'	=> 'required',
		'descricao'	=> 'required',
		'progresso'	=> 'required',
		'status'	=> 'required',
		'due_date'	=> 'required'
	];
}