<?php

namespace projetoModuloLaravel\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjetoRepository
 * @package namespace projetoModuloLaravel\Repositories;
 */
interface ProjetoRepository extends RepositoryInterface
{
    //
    public function findOrFail($id);
}
