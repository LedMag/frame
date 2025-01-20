<?php

namespace app\core\http;

class Response
{
    private string $content;
    private int $status;
    private array $headers;

    public function __construct(string $content = '', int $status = 200, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    /**
     * Establece el contenido de la respuesta.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Establece el código de estado HTTP.
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Establece un encabezado HTTP.
     */
    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * Envía la respuesta al cliente.
     */
    public function send(): void
    {
        // Enviar código de estado
        http_response_code($this->status);

        // Enviar encabezados
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        // Enviar contenido
        echo $this->content;
    }
}
