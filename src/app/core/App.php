<?php

namespace app\core;

use app\core\Router;
use app\core\Container;
use app\core\http\Request;
use app\core\http\Response;

class App
{
    private Router $router;
    private Container $container;

    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function handle(Request $request): Response
    {
        try {
            $this->applyMiddlewares($request);

            return $this->router->dispatch($request);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    private function applyMiddlewares(Request $request): void
    {
        $middlewares = $this->container->resolve('app\middlewares\TranslateMiddleware') ?? [];
        
        if(is_array($middlewares)) {
            foreach ($middlewares as $middleware) {
                $middleware->handle($request);
            }
        } else {
            $middlewares->handle($request);
        }
    }

    private function handleException(\Exception $e): Response
    {
        $status = $e->getCode() ?: 500;
        $message = $e->getMessage();

        // Opcional: log of errors, use a service of Logger if is registred.
        // if ($this->container->has(\App\Services\Logger::class)) {
        //     $logger = $this->container->resolve(\App\Services\Logger::class);
        //     $logger->error($message, ['exception' => $e]);
        // }

        return new Response($message, $status);
    }
}
