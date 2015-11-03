<?php

namespace projetoModuloLaravel\Services;

use projetoModuloLaravel\Repositories\ProjetoNotaRepository;
use projetoModuloLaravel\Validators\ProjetoNotaValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjetoNotaService
{

	protected $repository;
	protected $validator;

	public function __construct(ProjetoNotaRepository $repository, ProjetoNotaValidator $validator)
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