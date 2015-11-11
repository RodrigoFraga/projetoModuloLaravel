<?php

namespace projetoModuloLaravel\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use projetoModuloLaravel\Transformers\ClienteTransformer;

/**
* 
*/
class ClientePresenter extends FractalPresenter
{
	public function getTransformer()
	{
		return new ClienteTransformer();
	}
	
}