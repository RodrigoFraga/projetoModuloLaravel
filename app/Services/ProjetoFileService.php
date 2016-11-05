<?php

namespace projetoModuloLaravel\Services;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Contracts\ValidatorInterface;
use projetoModuloLaravel\Repositories\ProjetoFileRepository;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Validators\ProjetoFileValidator as Validator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjetoFileService
{

    private $repository;
    protected $projetoRepository;
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
     * @param ProjetoFileRepository $repository
     * @param ProjetoRepository $projetoRepository
     * @param Validator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjetoFileRepository $repository, ProjetoRepository $projetoRepository, Validator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->projetoRepository = $projetoRepository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function update(array $data, $id, $fileId)
    {
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            return $this->repository->update($data, $fileId);
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
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $projeto = $this->projetoRepository->skipPresenter()->find($data['projeto_id']);
            $projetoFile = $projeto->files()->create($data);

            $this->storage->put($projetoFile->getFileName(), $this->filesystem->get($data['file']));

            return $projetoFile;
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function destroy($projeto_id, $fileId)
    {
        $projetoFile = $this->repository->skipPresenter()->find($fileId);
        $exists = $this->storage->disk($this->storage->getDefaultDriver())->has($projetoFile->getFileName());
        //if ($this->storage->exits($projetoFile->getFileName())) {
        if ($exists) {
            $this->storage->delete($projetoFile->getFileName());
            $projetoFile->delete();
        }
    }

    public function getFileName($id)
    {
        $projetoFile = $this->repository->skipPresenter()->find($id);
        return $projetoFile->getFileName();
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
                return $this->storage->disk('local')->getAdapter()->getPathPrefix() . '/' . $projetoFile->getFileName();
            //return $this->storage->getDrive()->getAdapter()->getPathPrefix() . '/' . $projetoFile->getFileName();
        }
    }

    public function checkProjetoOwner($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projetoRepository->isOwner($projetoId, $userId);
    }

    public function checkProjetoMenbro($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projetoRepository->hasMenbro($projetoId, $userId);
    }

    public function checkAutorizacao($projetoId)
    {
        if ($this->checkProjetoOwner($projetoId) or $this->checkProjetoMenbro($projetoId)) {
            return true;
        }
        return false;
    }
}