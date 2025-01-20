<?php

namespace app\core;

use app\core\http\Request;
use app\core\http\Response;
use Exception;

class Router
{
    private array $routes = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function get(string $path, array $action, array $guards = []): void
    {
        $this->addRoute('GET', $path, $action, $guards);
    }

    public function post(string $path, array $action, array $guards = []): void
    {
        $this->addRoute('POST', $path, $action, $guards);
    }

    private function addRoute(string $method, string $path, array $action, array $guards): void
    {
        $normalizedPath = $this->normalizePath($path);
        $this->routes[$method][$normalizedPath] = ['action' => $action, 'guards' => $guards];
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $path = $this->normalizePath($request->getUri());

        foreach ($this->routes[$method] ?? [] as $routePath => $route) {
            $params = $this->match($routePath, $path);

            if ($params !== false) {
                // Ejecutar los guards antes de manejar la ruta
                $this->executeGuards($route['guards'], $request);

                return $this->handle($route['action'], $request, $params);
            }
        }

        throw new Exception("Route not found for {$method} {$path}", 404);
    }

    private function executeGuards(array $guards, Request $request): void
    {
        foreach ($guards as $guardClass) {
            $guard = $this->container->resolve($guardClass);
            if (!$guard->check($request)) {
                throw new Exception("Unauthorized", 403);
            }
        }
    }

    private function handle(array|string $handler, Request $request, array $params): Response
    {
        if (is_array($handler)) {
            [$controller, $method] = $handler;
            $controllerInstance = $this->container->resolve($controller);

            if (!method_exists($controllerInstance, $method)) {
                throw new Exception("Method {$method} not found in controller {$controller}");
            }

            $response = call_user_func([$controllerInstance, $method], $request, ...$params);
            
            if (!$response instanceof Response) {
                throw new Exception("The controller method must return an instance of Response.");
            }

            return $response;
        }

        if (is_callable($handler)) {
            // Llamar al callback y esperar un Response
            $response = call_user_func($handler, $request, ...$params);
            
            if (!$response instanceof Response) {
                throw new Exception("The callback must return an instance of Response.");
            }

            return $response;
        }

        throw new Exception("Invalid route handler");
    }


    private function normalizePath(string $path): string
    {
        return rtrim($path, '/') ?: '/';
    }

    private function match(string $routePath, string $requestPath): array|false
    {
        $regex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePath);
        $regex = "@^{$regex}$@";

        if (preg_match($regex, $requestPath, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return false;
    }
}
