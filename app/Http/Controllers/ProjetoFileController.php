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
        $data['projeto_id'] = $id;
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
        return $this->repository->find($fileId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showFile($id, $fileId)
    {
        $filePath = $this->service->getFilePath($id, $fileId);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);

        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($fileId)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $fileId)
    {
        return $this->service->update($request->all(), $id, $fileId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $fileId)
    {
        $this->service->destroy($id, $fileId);
        try {

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
