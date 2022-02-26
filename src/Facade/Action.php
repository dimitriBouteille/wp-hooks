<?php

namespace Dbout\WpHooks\Facade;

use Dbout\WpHooks\Builder\ActionBuilder;

/**
 * Class Action
 * @package Dbout\WpHooks\Facade
 *
 * @author Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @copyright Copyright (c) 2022
 *
 * @method static ActionBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static ActionBuilder run(string $hook, $args = null)
 * @method static ActionBuilder remove(string $hook, $callback = null, int $priority = 10)
 */
class Action extends AbstractFacade
{

    /**
     * @inheritdoc
     */
    protected static function getInstance(): ActionBuilder
    {
        return ActionBuilder::getInstance();
    }
}
