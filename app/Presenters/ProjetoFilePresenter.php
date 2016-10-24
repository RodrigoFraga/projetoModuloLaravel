<?php

namespace projetoModuloLaravel\Presenters;

use projetoModuloLaravel\Transformers\ProjetoFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjetoFilePresenter
 *
 * @package namespace projetoModuloLaravel\Presenters;
 */
class ProjetoFilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjetoFileTransformer();
    }
}
