<?php

namespace projetoModuloLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjetoMenbro extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'projeto_id',
		'menbro_id'
    ];

}
