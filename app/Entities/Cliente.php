<?php

namespace projetoModuloLaravel\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $fillable =[
		'nome',
		'responsavel',
		'email',
		'telefone',
		'end',
		'obs'
	];
}
