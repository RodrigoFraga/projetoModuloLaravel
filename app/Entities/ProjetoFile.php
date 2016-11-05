<?php

namespace projetoModuloLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjetoFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'projeto_id',
        'nome',
        'descricao',
        'extensao'
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class);
    }

    /**
     * @return array
     */
    public function getFilename()
    {
        return $this->id . '.' . $this->extensao;
    }

}
