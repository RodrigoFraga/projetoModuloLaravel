<?php

namespace projetoModuloLaravel\Services;

use projetoModuloLaravel\Repositories\ProjetoFileRepository;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Validators\ProjetoFileValidator as Validator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjetoFileService
{

    protected $repository;
    protected $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * projetoFileService constructor.
     * @param ProjetoRepository $repository
     * @param Validator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjetoRepository $repository, Validator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

    public function createFile(array $data)
    {
        $projeto = $this->repository->skipPresenter()->find($data['projeto_id']);
        $projeto->files()->create($data);
        $this->storage->put($data['nome'] . "." . $data['extensao'], $this->filesystem->get($data['file']));

    }

    public function deleteFile(array $data)
    {
        $projeto = $this->repository->skipPresenter()->find($data['projeto_id']);
        $projeto->files()->create($data);
        $this->storage->put($data['nome'] . "." . $data['extensao'], $this->filesystem->get($data['file']));

    }

    public function getFilePath($id)
    {
        $projetoFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projetoFile);
    }

    private function getBaseURL($projetoFile)
    {

    }
}