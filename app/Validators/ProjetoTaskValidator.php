<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjetoTaskValidator extends LaravelValidator
{
	
	protected $rules = [
		'projeto_id'	=> 'required|integer',
		'nome'	=> 'required',
	];
}