<?php

namespace projetoModuloLaravel\Services;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
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

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $projeto = $this->repository->skipPresenter()->find($data['projeto_id']);
            $projeto->files()->create($data);
            $this->storage->put($data['nome'] . "." . $data['extensao'], $this->filesystem->get($data['file']));

            return;
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function destroy(array $data, $projeto_id, $fileId)
    {
        $projetoFile = $this->repository->skipPresenter()->find($fileId);
        if ($this->storage->exits($projetoFile->id . '.' . $projetoFile->extensao)) {
            $this->storage->delete($projetoFile->id . '.' . $projetoFile->extensao);
            $projetoFile->delete();
        }
    }

    public function getFilePath($id, $fileId)
    {
        $projetoFile = $this->repository->skipPresenter()->find($fileId);
        return $this->getBaseURL($projetoFile);
    }

    private function getBaseURL($projetoFile)
    {
        switch ($this->storage->getDefaultDriver()) {
            case 'local':
                return $this->storage->getDrive()->getAdapter()->getPathPrefix() . '/' . $projetoFile->id . '.' . $projetoFile->extensao;
        }
    }

    public function checkProjetoOwner($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projetoId, $userId);
    }

    public function checkProjetoMenbro($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMenbro($projetoId, $userId);
    }

    public function checkAutorizacao($projetoId)
    {
        if ($this->checkProjetoOwner($projetoId) or $this->checkProjetoMenbro($projetoId)) {
            return true;
        }
        return false;
    }
}