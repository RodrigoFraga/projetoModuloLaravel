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

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    public function menbro()
    {
        return $this->belongsTo(User::class, 'menbro_id');
    }

}
