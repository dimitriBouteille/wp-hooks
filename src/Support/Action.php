<?php

namespace Dbout\WpHook\Support;

use Dbout\WpHook\Builder\ActionBuilder;

/**
 * Class Action
 * @package Dbout\WpHook\Support
 *
 * @method static ActionBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static ActionBuilder run(string $hook, $args = null)
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Action extends AbstractSupport
{

    /**
     * @return ActionBuilder
     */
    protected static function getInstance(): ActionBuilder
    {
        return ActionBuilder::getInstance();
    }

}