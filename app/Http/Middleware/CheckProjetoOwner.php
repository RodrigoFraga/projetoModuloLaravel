<?php

namespace projetoModuloLaravel\Http\Middleware;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Closure;
use projetoModuloLaravel\Repositories\ProjetoRepository;

class CheckProjetoOwner
{
    private $repository;

    public function __construct(ProjetoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Authorizer::getResourceOwnerId();
        $id = $request->projeto;

        if($this->repository->isOwner($id, $userId) == false){
            return ['sussess' => false];
        }
        return $next($request);
    }
}
