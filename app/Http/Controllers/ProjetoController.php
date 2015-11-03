<?php

namespace projetoModuloLaravel\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Services\ProjetoService;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjetoRepository $repository, ProjetoService $service)
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
        return $this->repository->findWhere(['owner_id' => Authorizer::getResourceOwnerId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($this->checkAutorizacao($id) == false){
            return ['error' => 'Não Autorizado'];
        }
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkProjetoOwner($id) == false){
            return ['error' => 'erro forbiden'];
        }

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkProjetoOwner($id) == false){
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

    private function checkAutorizacao($projetoId){
        if($this->checkProjetoOwner($projetoId) or $this->checkProjetoMenbro($projetoId)){
            return true;
        }
        return false;
    }
}
