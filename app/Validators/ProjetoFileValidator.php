<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjetoFileValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'projeto_id' => 'required|integer',
            'nome' => 'required',
            'descricao' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,gif,pdf,zip',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'projeto_id' => 'required|integer',
            'nome' => 'required',
            'descricao' => 'required',
        ]
    ];
}