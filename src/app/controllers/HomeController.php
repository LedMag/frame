<?php

namespace app\controllers;

use app\core\Controller;
use app\core\http\Request;

use app\components\header\HeaderComponent;
use app\services\TranslateService;

class HomeController extends Controller
{
    public function index(Request $request, $params)
    {
        $translate = new TranslateService($params["lang"]);
        $header = new HeaderComponent(["translate" => $translate]);

        $html = $header->render([
            'title' => 'Welcome to My Website',
            'transtale' => $translate
        ]);

        $styles = array_filter([$header->getStyles()]);
        $scripts = array_filter([$header->getScripts()]);

        $this->view->renderHTML($html, $styles, $scripts);
    }
}
