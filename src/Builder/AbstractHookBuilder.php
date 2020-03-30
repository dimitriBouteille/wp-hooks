<?php

namespace Dbout\WpHook\Builder;

/**
 * Class AbstractHookBuilder
 * @package Dbout\WpHook
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
abstract class AbstractHookBuilder
{

    /**
     * @var array
     */
    protected static $_instances = [];

    /**
     * @param $names
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @return $this
     */
    public function add($names, $callback,int $priority = 10,  int $acceptedArgs = 3): self
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
     * @param null $callback
     * @param int $priority
     * @return $this
     */
    public function remove(string $hook, $callback = null, int $priority = 10): self
    {
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
     */
    protected function addEvent(string $hookName, $callback, int $priority, int $acceptedArgs)
    {
        // Closure or [MyClass::class, 'callback']
        if($callback instanceof \Closure || is_array($callback) || is_string($callback)) {
            $this->registerHook($hookName, $callback, $priority, $acceptedArgs);
        } else if(is_string($callback)) {

            // 'MyClass::myFunction'
            if(strpos($callback, '::') >= 0) {

                $this->registerHook($hookName, $this->makeCallbackClassFunction($callback), $priority, $acceptedArgs);
            } else {

                // Function name
                // ie : myFunction
                $this->registerHook($hookName, $callback, $priority, $acceptedArgs);
            }
        }

    }

    /**
     * @param string $callback
     * @return array
     */
    protected function makeCallbackClassFunction(string $callback): array
    {
        die('test');
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
     * @param int $priority
     * @param int $acceptedArgs
     * @return mixed
     */
    protected abstract function registerHook(string $hookName, $callback, int $priority, int $acceptedArgs);

}