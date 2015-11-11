<?php

namespace projetoModuloLaravel\Presenters;

use projetoModuloLaravel\Transformers\TesteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TestePresenter
 *
 * @package namespace projetoModuloLaravel\Presenters;
 */
class TestePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TesteTransformer();
    }
}
