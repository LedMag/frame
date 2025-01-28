<?php

namespace app\core;

use app\core\http\Request;

abstract class Controller
{
    protected View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    abstract public function index(Request $request, $params);
}
