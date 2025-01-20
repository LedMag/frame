<?php

namespace app\core;

use Exception;
use ReflectionClass;
use ReflectionException;

class Container
{
    private array $bindings = [];

    public function bind(string $key, callable|string $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function bindSingleton(string $key): void
    {
        $this->bindings[$key] = function () use ($key) {
            static $instance = null;
            if ($instance === null) {
                $instance = $this->resolve($key);
            }
            return $instance;
        };
    }

    public function resolve(string $key): mixed
    {
        if (isset($this->bindings[$key])) {
            $resolver = $this->bindings[$key];

            return is_callable($resolver) ? $resolver($this) : new $resolver;
        }

        return $this->build($key);
    }

    private function build(string $class): object
    {
        try {
            $reflector = new ReflectionClass($class);

            if (!$reflector->isInstantiable()) {
                throw new Exception("Class {$class} is not instantiable.");
            }

            $constructor = $reflector->getConstructor();

            if ($constructor === null) {
                return new $class;
            }

            $parameters = $constructor->getParameters();
            $dependencies = array_map(function ($parameter) {
                $dependencyClass = $parameter->getType();
                if ($dependencyClass === null) {
                    throw new Exception("Cannot resolve parameter {$parameter->getName()}.");
                }
                return $this->resolve($dependencyClass->getName());
            }, $parameters);

            return $reflector->newInstanceArgs($dependencies);
        } catch (ReflectionException $e) {
            throw new Exception("Failed to resolve class {$class}: " . $e->getMessage());
        }
    }
}
