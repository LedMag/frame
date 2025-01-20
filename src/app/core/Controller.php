<?php

namespace app\core;

use app\core\http\Request;
use app\core\http\Response;

abstract class Controller
{
    protected View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    abstract public function index();
    
    // protected function render(string $view, array $data = [], array $extraHeaders = []): Response
    // {
    //     // Construye la plantilla completa con la vista proporcionada
    //     $header = $this->includeView($view, $data);
    //     $content = $this->includeView($view, $data);
    //     $footer = $this->includeView($view, $data);

    //     // Incluir la estructura base de la página (layout)
    //     $layout = $this->includeView('layouts/main', [
    //         'content' => $content,
    //         'title' => $data['title'] ?? 'Default Title',
    //         'extraHeaders' => $extraHeaders,
    //     ]);

    //     return new Response($layout, 200, ['Content-Type' => 'text/html']);
    // }

    // private function includeView(string $view, array $data = []): string
    // {
    //     extract($data);

    //     ob_start();
    //     include __DIR__ . '/../views/' . $view . '.php';
    //     return ob_get_clean();
    // }

    // protected function redirect(string $url, int $statusCode = 302): Response
    // {
    //     return new Response('', $statusCode, ['Location' => $url]);
    // }
}
