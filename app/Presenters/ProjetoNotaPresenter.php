<?php

namespace projetoModuloLaravel\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use projetoModuloLaravel\Transformers\ProjetoNotaTransformer;

/**
* 
*/
class ProjetoNotaPresenter extends FractalPresenter
{
	public function getTransformer()
	{
		return new ProjetoNotaTransformer();
	}
	
}