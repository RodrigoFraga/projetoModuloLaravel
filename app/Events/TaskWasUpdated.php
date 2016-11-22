<?php
/**
 * Created by PhpStorm.
 * User: fraga
 * Date: 20/11/16
 * Time: 00:07
 */

namespace projetoModuloLaravel\Events;


use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use projetoModuloLaravel\Entities\ProjetoTask;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class TaskWasUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $task;
    public $projeto;

    public function __construct(ProjetoTask $task)
    {
        $this->task = $task;
        $this->projeto = $task->projeto;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.' . Authorizer::getResourceOwnerId()];
    }
}