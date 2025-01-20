<?php

namespace app\core;

use app\core\Container;
use ReflectionClass;
use ReflectionParameter;

class DependencyRegistrar {
    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function registerDependenciesByPattern(string $directory, string $namespace, string $pattern): void
    {
        $files = glob("{$directory}/*.php");

        foreach ($files as $file) {
            $className = $namespace . '\\' . pathinfo($file, PATHINFO_FILENAME);

            if (class_exists($className) && preg_match($pattern, $className)) {
                $this->container->bind($className, function () use ($className) {
                    return $this->resolveDependencies($className);
                });
            }
        }
    }

    private function resolveDependencies(string $className): object
    {
        $reflectionClass = new ReflectionClass($className);

        $constructor = $reflectionClass->getConstructor();
        if ($constructor) {
            $parameters = $constructor->getParameters();
            $dependencies = array_map(function (ReflectionParameter $param) {
                $type = $param->getType();
                if ($type && !$type->isBuiltin()) {
                    return $this->container->resolve($type->getName());
                }
                throw new \Exception("Unable to resolve parameter {$param->getName()} for {$param->getDeclaringClass()->getName()}");
            }, $parameters);

            return $reflectionClass->newInstanceArgs($dependencies);
        }

        return new $className();
    }
}
