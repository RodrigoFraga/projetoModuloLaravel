<?php

namespace projetoModuloLaravel\Validators;

use Prettus\Validator\LaravelValidator;

class ProjetoMenbroValidator extends LaravelValidator
{

    protected $rules = [
        'projeto_id' => 'required|integer',
        'menbro_id' => 'required',
    ];
}