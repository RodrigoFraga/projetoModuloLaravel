<?php

namespace projetoModuloLaravel\Presenters;

use projetoModuloLaravel\Transformers\ProjetoMenbroTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjetoMenbroPresenter
 *
 * @package namespace projetoModuloLaravel\Presenters;
 */
class ProjetoMenbroPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjetoMenbroTransformer();
    }
}
