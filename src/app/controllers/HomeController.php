<?php

namespace app\controllers;

use app\core\Controller;

use app\components\header\HeaderComponent;

class HomeController extends Controller
{
    public function index()
    {
        $header = new HeaderComponent();

        $html = $header->render(['title' => 'Welcome to My Website']);

        $styles = array_filter([$header->getStyles()]);
        $scripts = array_filter([$header->getScripts()]);

        $this->view->renderHTML($html, $styles, $scripts);
    }
}
