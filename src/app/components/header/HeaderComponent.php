<?php

namespace app\components\header;

use app\core\Component;

class HeaderComponent extends Component
{
    protected string $template = __DIR__.'/header.html.php';

    public function __construct(array $services = [])
    {
        parent::__construct($services);
    }
}
