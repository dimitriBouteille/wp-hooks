<?php

namespace Dbout\WpHooks\Facade;

/**
 * Class AbstractFacade
 * @package Dbout\WpHooks\Facade
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
abstract class AbstractFacade
{

    /**
     * @return mixed
     */
    protected static abstract function getInstance();

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = static::getInstance();
        return $instance->$name(...$arguments);
    }

}