<?php

namespace projetoModuloLaravel\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Services\ProjetoFileService;
use Illuminate\Http\Request;

class ProjetoFileController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjetoRepository $repository, ProjetoFileService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->findOwner(Authorizer::getResourceOwnerId(), 4);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $extensao = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extensao'] = $extensao;
        $data['nome'] = $request->nome;
        $data['projeto_id'] = $request->projeto_id;
        $data['descricao'] = $request->descricao;

        return $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->checkAutorizacao($id) == false) {
            return ['error' => 'Não Autorizado'];
        }
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->checkProjetoOwner($id) == false) {
            return ['error' => 'erro forbiden'];
        }

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->checkProjetoOwner($id) == false) {
            return ['error' => 'erro forbiden'];
        }

        $this->repository->delete($id);
    }

    private function checkProjetoOwner($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projetoId, $userId);
    }

    private function checkProjetoMenbro($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMenbro($projetoId, $userId);
    }

    private function checkAutorizacao($projetoId)
    {
        if ($this->checkProjetoOwner($projetoId) or $this->checkProjetoMenbro($projetoId)) {
            return true;
        }
        return false;
    }
}
