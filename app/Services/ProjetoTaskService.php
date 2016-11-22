<?php

namespace projetoModuloLaravel\Services;

use projetoModuloLaravel\Repositories\ProjetoTaskRepository;
use projetoModuloLaravel\Validators\ProjetoTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjetoTaskService
{

    protected $repository;
    protected $validator;

    public function __construct(ProjetoTaskRepository $repository, ProjetoTaskValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
}