<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\VisitasService;
use Illuminate\Support\Facades\Cache;

class RegistrarVisita
{
    private int $maxAttempts = 5;
    private int $windowMinutes = 5;
    private int $blockMinutes = 60;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // Executa a requisição apenas uma vez.
        $response = $next($request);

        // Se não for 404, registra a visita e retorna a resposta.
        if ($response->getStatusCode() !== 404 || !$ip) {
            app(VisitasService::class)->registrar($request);
            return $response;
        }

        $ipHash = hash('sha256', $ip);

        $blockedKey = "security:blocked:{$ipHash}";
        $attemptsKey = "security:404:{$ipHash}";

        // Verifica se o IP está bloqueado.
        if (Cache::has($blockedKey)) {
            return response('Acesso temporariamente bloqueado.', 403);
        }    

        // Ignora query strings e normaliza a barra inicial.
        $path = '/' . ltrim($request->path(), '/');

        $attempts = Cache::get($attemptsKey, []);

        // Registra apenas URLs diferentes.
        $attempts[$path] = true;

        Cache::put(
            $attemptsKey,
            $attempts,
            now()->addMinutes(5)
        );

        // Bloqueia após 5 caminhos distintos retornarem 404.
        if (count($attempts) >= 5) {
            Cache::put(
                $blockedKey,
                true,
                now()->addMinutes(60)
            );

            return response('Acesso temporariamente bloqueado.', 403);
        }

        // Registra a visita e preserva a resposta 404 original.
        app(VisitasService::class)->registrar($request);

        return $response;
    }
}
