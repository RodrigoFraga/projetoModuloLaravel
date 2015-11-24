<?php

namespace projetoModuloLaravel\Presenters;

use projetoModuloLaravel\Transformers\ProjetoTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjetoTaskPresenter
 *
 * @package namespace projetoModuloLaravel\Presenters;
 */
class ProjetoTaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjetoTaskTransformer();
    }
}
