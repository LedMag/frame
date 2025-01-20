<?php

namespace app\core;

abstract class Component
{
    protected string $template;
    protected string $styles;
    protected string $scripts;
    protected array $services = [];
    protected array $subcomponents = [];

    public function __construct(array $services = [])
    {
        $this->services = $services;
        $this->loadAssets();
    }

    public function addSubcomponent(string $zone, Component $component): void
    {
        $this->subcomponents[$zone][] = $component;
    }

    public function render(array $data = []): string
    {
        $output = $this->renderTemplate($this->template, $data);

        foreach ($this->subcomponents as $zone => $components) {
            $zoneContent = array_map(fn($component) => $component->render(), $components);
            $output = str_replace("{{ $zone }}", implode("\n", $zoneContent), $output);
        }

        $output = preg_replace('/\{\{ \w+ \}\}/', '', $output);

        return $output;
    }

    private function renderTemplate(string $path, array $data): string
    {
        if (!file_exists($path)) {
            throw new \Exception("Template not found: $path");
        }

        extract($data);
        ob_start();
        include $path;
        return ob_get_clean();
    }

    protected function getTemplatePath(): string
    {
        return dirname((new \ReflectionClass($this))->getFileName()) . '/' . $this->template;
    }

    protected function loadAssets(): void
    {
        $dir = dirname((new \ReflectionClass($this))->getFileName());
        $this->styles = file_exists("$dir/{$this->getStyleName()}") ? "$dir/{$this->getStyleName()}" : null;
        $this->scripts = file_exists("$dir/{$this->getScriptName()}") ? "$dir/{$this->getScriptName()}" : null;
    }

    public function getStyles(): ?string
    {
        return $this->styles;
    }

    public function getScripts(): ?string
    {
        return $this->scripts;
    }

    protected function getStyleName(): string
    {
        return strtolower((new \ReflectionClass($this))->getShortName()) . '.css';
    }

    protected function getScriptName(): string
    {
        return strtolower((new \ReflectionClass($this))->getShortName()) . '.js';
    }
}
