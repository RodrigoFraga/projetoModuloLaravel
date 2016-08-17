<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjetoFileValidator extends LaravelValidator
{

    protected $rules = [
        'projeto_id' => 'required|integer',
        'nome' => 'required',
        'descricao' => 'required',
        'file' => 'required|mimes:jpeg,jpg,png,gif,pdf,zip',
    ];
}