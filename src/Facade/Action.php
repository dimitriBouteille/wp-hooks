<?php

namespace Dbout\WpHooks\Facade;

use Dbout\WpHooks\Builder\ActionBuilder;

/**
 * Class Action
 * @package Dbout\WpHooks\Facade
 *
 * @method static ActionBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static ActionBuilder run(string $hook, $args = null)
 * @method static ActionBuilder remove(string $hook, $callback = null, int $priority = 10)
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Action extends AbstractFacade
{

    /**
     * @return ActionBuilder
     */
    protected static function getInstance(): ActionBuilder
    {
        return ActionBuilder::getInstance();
    }

}