<?php

namespace projetoModuloLaravel\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoNotaRepository;
use projetoModuloLaravel\Repositories\ProjetoRepositoryEloquent as ProjetoRepository;
use projetoModuloLaravel\Services\ProjetoNotaService;
use Illuminate\Http\Request;

class ProjetoNotaController extends Controller
{
    private $repository;
    private $projetoRepository;
    private $service;
    private $modelName = 'Projeto Nota';

    public function __construct(ProjetoNotaRepository $repository, ProjetoNotaService $service, ProjetoRepository $projetoRepository)
    {
        $this->repository = $repository;
        $this->projetoRepository = $projetoRepository;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['projeto_id'] = $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $notaId)
    {
        try {
            $resultado = $this->repository->findWhere(['projeto_id' => $id, 'id' => $notaId]);
            if (isset($resultado['data']) && count($resultado['data']) == 1) {
                $resultado = [
                    'data' => $resultado['data'][0]
                ];
            }
            return $resultado;

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
    public function update(Request $request, $id, $notaId)
    {
        $data = $request->all();
        $data['projeto_id'] = $id;
        try {
            $this->service->update($data, $notaId);

            return ['success' => false, $this->modelName . ' atualizado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, $this->modelName . ' não pode ser atualizado.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . ' não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao atualizar o ' . $this->modelName];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $notaId)
    {
        try {
            $this->repository->skipPresenter()->find($notaId)->delete();
            return ['success' => true, $this->modelName . ' deletado com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . ' não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o ' . $this->modelName];
        }
    }

    /*private function checkProjetoOwner($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projetoRepository->isOwner($projetoId, $userId);
    }

    private function checkProjetoMenbro($projetoId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->projetoRepository->hasMenbro($projetoId, $userId);
    }

    private function checkAutorizacao($projetoId)
    {
        if ($this->checkProjetoOwner($projetoId) or $this->checkProjetoMenbro($projetoId)) {
            return true;
        }
        return false;
    }*/
}
