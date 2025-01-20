<?php

namespace app\middlewares;

use app\core\http\Request;
use Exception;

class TranslateMiddleware
{
    private array $translations = [
        'en' => [
            '/' => '/',
            '/about'  => '/about',
        ],
        'es' => [
            '/' => '/',
            '/sobre-nosotros'  => '/about',
        ]
    ];

    public function handle(Request $request)
    {
        $lang = $this->getLangFromRequest($request);

        $uri = $request->getUri();

        $translatedUri = $this->translateUri($uri, $lang);

        $request->setUri($translatedUri);

        $this->addCustomHeaders($request, $lang);

        return $request;
    }

    private function getLangFromRequest(Request $request): string
    {
        $segments = explode('/', $request->getUri());
        $lang = $segments[1] ?? 'en';

        return in_array($lang, ['en', 'es']) ? $lang : 'en';
    }

    private function translateUri(string $uri, string $lang): string
    {
        $translations = $this->translations[$lang] ?? [];

        foreach ($translations as $original => $translated) {
            if (strpos($uri, $original) !== false) {
                $uri = str_replace("/$lang", '', str_replace($original, $translated, $uri));
            }
        }

        return $uri;
    }

    private function addCustomHeaders(Request $request, string $lang): void
    {
        // Aquí puedes agregar cualquier dato que quieras en los headers
        // $request->setHeader('X-Language', $lang);
        // $request->setHeader('X-Country', 'US');  // Por ejemplo, agregar país
    }
}
