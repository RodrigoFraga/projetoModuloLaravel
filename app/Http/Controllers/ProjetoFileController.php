<?php

namespace projetoModuloLaravel\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Repositories\ProjetoFileRepository as Repository;
use projetoModuloLaravel\Services\ProjetoFileService;
use Illuminate\Http\Request;

class ProjetoFileController extends Controller
{
    private $repository;
    private $service;
    private $modelName = 'Arquivo do Projeto';

    public function __construct(Repository $repository, ProjetoFileService $service)
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
        $file = $request->file('file');
        $extensao = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extensao'] = $extensao;
        $data['nome'] = $request->nome;
        $data['projeto_id'] = $request->projeto_id;
        $data['descricao'] = $request->descricao;

        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $fileId)
    {
        if ($this->service->checkAutorizacao($id) == false) {
            return ['error' => 'Não Autorizado'];
        }
        return $this->repository->find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showFile($id, $fileId)
    {
        if ($this->service->checkAutorizacao($id) == false) {
            return ['error' => 'Não Autorizado'];
        }
        return response()->download($this->service->getFilePath($id, $fileId));
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
        if ($this->service->checkProjetoOwner($id) == false) {
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
    public function destroy($id, $fileId)
    {
        if ($this->service->checkProjetoOwner($id) == false) {
            return ['error' => 'erro forbiden'];
        }

        try {
            $this->service->destroy($id, $fileId);

            return ['success' => true, $this->modelName . ' deletado com sucesso!'];
        } catch (QueryException $e) {
            return ['error' => true, $this->modelName . ' não pode ser apagado pois existe um ou mais projetos vinculados a ele.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, $this->modelName . ' não encontrado.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Ocorreu algum erro ao excluir o ' . $this->modelName];
        }

    }
}
