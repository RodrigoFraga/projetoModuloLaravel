<?php

namespace projetoModuloLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Projeto extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'owner_id',
		'cliente_id',
		'nome',
		'descricao',
		'progresso',
		'status',
		'due_date'
    ];

    public function notas(){
    	return $this->hasMany(ProjetoNota::class);
    }

    public function menbros(){
        return $this->belongsToMany(User::class, 'projeto_menbros', 'projeto_id', 'menbro_id');
    }

}
