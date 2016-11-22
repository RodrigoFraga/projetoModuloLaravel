<?php

namespace projetoModuloLaravel\Http\Middleware;

use Closure;
use projetoModuloLaravel\Services\ProjetoService;

class CheckProjetoOwner
{
    private $service;

    public function __construct(ProjetoService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projetoId = $request->route('id') ? $request->route('id') : $request->route('projetos');

        if ($this->service->checkProjetoOwner($projetoId) == false) {
            return ['error' => 'Access forbidden'];
        }
        return $next($request);
    }
}
