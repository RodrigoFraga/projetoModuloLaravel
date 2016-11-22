<?php

namespace projetoModuloLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjetoTask extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'projeto_id',
        'nome',
        'start_date',
        'due_date',
        'status',
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

}
