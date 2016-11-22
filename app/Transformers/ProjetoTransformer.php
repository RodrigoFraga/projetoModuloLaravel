<?php

namespace projetoModuloLaravel\Transformers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use projetoModuloLaravel\Entities\Projeto;
use League\Fractal\TransformerAbstract;

/**
 *
 */
class ProjetoTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['menbro', 'cliente', 'files', 'notas', 'tasks'];

    public function transform(Projeto $projeto)
    {
        return [
            'id' => $projeto->id,
            'cliente_id' => $projeto->cliente_id,
            'owner_id' => $projeto->owner_id,
            'nome' => $projeto->nome,
            'descricao' => $projeto->descricao,
            'progresso' => (int)$projeto->progresso,
            'status' => $projeto->status,
            'due_date' => $projeto->due_date,
            'isMenbro' => $projeto->owner_id != Authorizer::getResourceOwnerId(),
            'total_tasks' => $projeto->tasks()->count(),
            'opened_tasks' => $this->countOpenTasks($projeto)
        ];
    }

    public function includeMenbro(Projeto $projeto)
    {
        return $this->collection($projeto->menbros, new MenbroTransformer());
    }

    public function includeCliente(Projeto $projeto)
    {
        if (!is_null($projeto->cliente)) {
            return $this->item($projeto->cliente, new ClienteTransformer());
        }
    }

    public function includeFiles(Projeto $projeto)
    {
        return $this->collection($projeto->files, new ProjetoFileTransformer());
    }

    public function includeNotas(Projeto $projeto)
    {
        return $this->collection($projeto->notas, new ProjetoNotaTransformer());
    }

    public function includeTasks(Projeto $projeto)
    {
        return $this->collection($projeto->tasks, new ProjetoTaskTransformer());
    }

    private function countOpenTasks($projeto)
    {
        $count = 0;
        foreach ($projeto->tasks as $task) {
            //task incompleta = 1
            if ($task->status == 1) {
                $count++;
            }
        }
        return $count;
    }
}