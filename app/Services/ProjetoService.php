<?php

namespace projetoModuloLaravel\Services;

use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Validators\ProjetoValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class projetoService
{

	protected $repository;
	protected $validator;

	public function __construct(ProjetoRepository $repository, ProjetoValidator $validator)
	{
		$this->repository = $repository;
		$this->validator = $validator;
	}

	public function create(array $data)
	{
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function update(array $data, $id)
	{
		try{
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data, $id);
		}catch (ValidatorException $e){
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}
}