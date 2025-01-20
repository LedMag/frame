<?php

use app\core\Container;
use app\core\DependencyRegistrar;

function bootstrap()
{
    $container = new Container();
    $registrar = new DependencyRegistrar($container);

    $registrar->registerDependenciesByPattern(__DIR__ . '/services', 'app\services', '/Service$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/controllers', 'app\controllers', '/Controller$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/middlewares', 'app\middlewares', '/Middleware$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/components', 'app\components', '/Component$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/view', 'app\core', '/View$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/request', 'app\core\http', '/Request$/');
    $registrar->registerDependenciesByPattern(__DIR__ . '/responce', 'app\core\http', '/Responce$/');

    $router = $container->resolve(app\core\Router::class);

    require_once __DIR__ . '/routes/web.php';

    return new app\core\App($router, $container);
}
