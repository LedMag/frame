<?php

namespace app\core;

class View
{
    public function renderHTML(string $html, array $styles = [], array $scripts = []): void
    {
        foreach ($styles as $style) {
            echo "<link rel='stylesheet' href='/assets/" . basename($style) . "'>";
        }

        echo $html;

        foreach ($scripts as $script) {
            echo "<script src='/assets/" . basename($script) . "'></script>";
        }
    }
}