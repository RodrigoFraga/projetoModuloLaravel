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

	public function projetos()
	{
		return $this->hasMany(Projeto::class);
	}
}
