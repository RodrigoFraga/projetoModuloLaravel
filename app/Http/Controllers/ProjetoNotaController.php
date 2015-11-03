<?php

namespace projetoModuloLaravel\Http\Controllers;

use projetoModuloLaravel\Repositories\ProjetoNotaRepository;
use projetoModuloLaravel\Services\ProjetoNotaService;
use Illuminate\Http\Request;

class ProjetoNotaController extends Controller
{
    private $repository;
    private $service;

    public function __construct(ProjetoNotaRepository $repository, ProjetoNotaService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['projeto_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $notaId)
    {
        return $this->repository->findWhere(['projeto_id'=>$id, 'id'=>$notaId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $notaId)
    {
        return $this->service->update($request->all(), $notaId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $notaId)
    {
        $this->repository->delete($notaId);
    }
}
