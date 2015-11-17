<?php

namespace projetoModuloLaravel\Presenters;

use projetoModuloLaravel\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TestePresenter
 *
 * @package namespace projetoModuloLaravel\Presenters;
 */
class UserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
