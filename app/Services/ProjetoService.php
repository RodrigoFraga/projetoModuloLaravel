<?php

namespace projetoModuloLaravel\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

    public function addMenbro()
    {
        //
    }

    public function removeMenbro()
    {
        //
    }

    public function isMenbro()
    {
        //
    }

//    public function createFile(array $data)
//    {
//        $projeto = $this->repository->skipPresenter()->find($data['projeto_id']);
//        $projeto->files()->create($data);
//        Storage::put($data['nome'] . "." . $data['extensao'], File::get($data['file']));
//
//    }
//
//    public function deleteFile(array $data)
//    {
//        $projeto = $this->repository->skipPresenter()->find($data['projeto_id']);
//        $projeto->files()->create($data);
//        Storage::put($data['nome'] . "." . $data['extensao'], File::get($data['file']));
//
//    }

//    public function getFilePath($id)
//    {
//        $projetoFile = $this->repository->skipPresenter()->find($id);
//        return $this->getBaseURL($projetoFile);
//    }

//    private function getBaseURL($projetoFile)
//    {
//        
//    }
}