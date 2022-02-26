<?php

namespace Dbout\WpHooks\Builder;

/**
 * Class AbstractHookBuilder
 * @package Dbout\WpHooks\Builder
 *
 * @author Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @copyright Copyright (c) 2022
 */
abstract class AbstractHookBuilder
{

    /**
     * @var array
     */
    protected static array $_instances = [];

    /**
     * @param $names
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @return $this
     * @throws \ReflectionException
     */
    public function add($names, $callback, int $priority = 10,  int $acceptedArgs = 3): self
    {
        if(is_string($names)) {
            $names = [$names];
        }

        foreach ($names as $name) {
            $this->addEvent($name, $callback, $priority, $acceptedArgs);
        }

        return $this;
    }

    /**
     * @param string $hook
     * @param null|array|callable|string $callback
     * @param int $priority
     * @return $this
     */
    public function remove(string $hook, $callback = null, int $priority = 10): self
    {
        $this->removeHook($hook, $callback, $priority);
        return $this;
    }

    /**
     * Run all actions or filters registered with the hook
     *
     * @param string $hookName
     * @param null $args
     * @return mixed
     */
    public function run(string $hookName, $args = null)
    {
        if(is_array($args)) {
            return $this->runWithRefArray($hookName, $args);
        }

        return $this->runDefault($hookName, $args);
    }

    /**
     * Get instance
     *
     * @return mixed
     */
    public static function getInstance(): AbstractHookBuilder
    {
        $class = get_called_class();
        if(!key_exists($class, self::$_instances)) {
            self::$_instances[$class] = new $class();
        }

        return self::$_instances[$class];
    }

    /**
     * @param string $hookName
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @throws \ReflectionException
     */
    protected function addEvent(string $hookName, $callback, int $priority = 10, int $acceptedArgs = 3)
    {
        if($callback instanceof \Closure) {

            // Closure
            $this->registerHook($hookName, $callback, $priority, $acceptedArgs);
        } else if(is_array($callback)) {

            // [MyClass::class, 'callback']
            list($instance, $function) = $callback;
            if(is_string($instance)) {
                $this->registerHook($hookName, [$this->makeInstance($instance), $function], $priority, $acceptedArgs);
            } else {
                $this->registerHook($hookName, $callback, $priority, $acceptedArgs);
            }
        } else if(is_string($callback) && strpos($callback, '@') !== false) {

            // MyClass@myFunction
            list($class, $function) = explode('@', $callback);
            $this->registerHook($hookName, [$this->makeInstance($class), $function], $priority, $acceptedArgs);
        } else {

            // Function name
            // ie : myFunction
            $this->registerHook($hookName, $callback, $priority, $acceptedArgs);
        }

    }

    /**
     * Create new instance of class
     * @param string $class
     * @return object
     * @throws \ReflectionException
     */
    protected function makeInstance(string $class)
    {
        return (new \ReflectionClass($class))->newInstanceWithoutConstructor();
    }

    /**
     * Call hook (action or filter) with array argument
     *
     * @param string $hook  Hook name
     * @param array $args   Arguments
     * @return mixed
     */
    protected abstract function runWithRefArray(string $hook, array $args = []);

    /**
     * Call hook (action or filter) without array argument
     *
     * @param string $hook
     * @param $args
     * @return mixed
     */
    protected abstract function runDefault(string $hook, $args);

    /**
     * @param string $hookName
     * @param $callback
     * @param int|null $priority
     * @param int|null $acceptedArgs
     * @return void
     */
    protected abstract function registerHook(string $hookName, $callback, ?int $priority, ?int $acceptedArgs): void;

    /**
     * @param string $hookName
     * @param $callback
     * @param int|null $priority
     * @return void
     */
    protected abstract function removeHook(string $hookName, $callback, ?int $priority = null): void;
}
