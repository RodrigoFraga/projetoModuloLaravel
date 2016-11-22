<?php

namespace projetoModuloLaravel\Services;

use projetoModuloLaravel\Repositories\ProjetoMenbroRepository;
use projetoModuloLaravel\Validators\ProjetoMenbroValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjetoMenbroService
{

    protected $repository;
    protected $validator;

    public function __construct(ProjetoMenbroRepository $repository, ProjetoMenbroValidator $validator)
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
}