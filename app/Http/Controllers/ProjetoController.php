<?php

namespace projetoModuloLaravel\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoRepository;
use projetoModuloLaravel\Services\ProjetoService;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    private $repository;
    private $service;
    private $modelName = 'Projeto';

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
        return $this->service->create($request->all());
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
        try {
            return $this->repository->find($id);

        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . 'não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao recuperar o' . $this->modelName];
        }
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

        try {
            $this->repository->findOrFail($id)->delete();
            return ['success' => true, 'Projeto deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, 'Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o projeto.'];
        }
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
