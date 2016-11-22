
<?php

namespace projetoModuloLaravel\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoMenbroRepository;
use projetoModuloLaravel\Repositories\ProjetoRepositoryEloquent as ProjetoRepository;
use projetoModuloLaravel\Services\ProjetoMenbroService;
use Illuminate\Http\Request;

class ProjetoMenbroController extends Controller
{
    private $repository;
    private $service;
    private $modelName = 'Projeto Menbro';

    public function __construct(ProjetoMenbroRepository $repository, ProjetoMenbroService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->middleware('check.projeto.owner', ['except' => ['index', 'show']]);
        $this->middleware('check.projeto.permission', ['except' => ['store', 'destroy']]);
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
    public function show($id, $projetoMenbroId)
    {
        try {
            $resultado = $this->repository->findWhere(['projeto_id' => $id, 'id' => $projetoMenbroId]);
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $projetoMenbroId)
    {
        try {
            $this->repository->skipPresenter()->find($projetoMenbroId)->delete();
            return ['success' => true, $this->modelName . ' deletado com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . ' não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o ' . $this->modelName];
        }
    }
}
