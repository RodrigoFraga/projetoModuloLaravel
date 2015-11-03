<?php

namespace projetoModuloLaravel\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use projetoModuloLaravel\Transformers\ProjetoTransformer;

/**
* 
*/
class ProjetoPresenter extends FractalPresenter
{
	public function getTransformer()
	{
		return new ProjetoTransformer();
	}
	
}