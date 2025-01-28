<?php

namespace app\core\http;

class Request
{
    private string $method;
    private string $lang;
    private string $uri;
    private array $query;
    private array $body;
    private array $headers;

    public function __construct(array $server, array $query = [], array $body = [], array $files = [])
    {
        $this->method = $server['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $this->parseUri($server['REQUEST_URI'] ?? '/');
        $this->lang = explode('/', $this->uri)[1] ?? null;
        $this->query = $query;
        $this->body = $body + $files;
        $this->headers = $this->parseHeaders($server);
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $default;
    }

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    private function parseUri(string $uri): string
    {
        return parse_url($uri, PHP_URL_PATH);
    }

    private function parseHeaders(array $server): array
    {
        $headers = [];
        foreach ($server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = str_replace('_', '-', substr($key, 5));
                $headers[$name] = $value;
            }
        }
        return $headers;
    }
}
