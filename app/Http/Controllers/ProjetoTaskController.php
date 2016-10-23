<?php

namespace projetoModuloLaravel\Http\Controllers;

use projetoModuloLaravel\Repositories\ProjetoTaskRepository;
use projetoModuloLaravel\Services\ProjetoTaskService;
use Illuminate\Http\Request;

class ProjetoTaskController extends Controller
{
    private $repository;
    private $service;
    private $modelName = 'Projeto Task';

    public function __construct(ProjetoTaskRepository $repository, ProjetoTaskService $service)
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $task)
    {
        try {

            $resultado = $this->repository->findWhere(['projeto_id' => $id, 'id' => $task]);
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
    public function update(Request $request, $id, $task)
    {
        try {
            $this->service->update($request->all(), $task);

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
    public function destroy($id, $task)
    {
        try {
            $this->repository->skipPresenter()->find($task)->delete();
            return ['success' => true, $this->modelName . ' deletado com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . ' não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o ' . $this->modelName];
        }
    }
}
