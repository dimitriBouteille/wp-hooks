<?php

namespace Dbout\WpHooks\Facade;

use Dbout\WpHooks\Builder\FilterBuilder;

/**
 * Class Filter
 * @package Dbout\WpHooks\Facade
 *
 * @method static FilterBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static FilterBuilder run(string $hook, $args = null)
 * @method static FilterBuilder remove(string $hook, $callback = null, int $priority = 10)
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Filter extends AbstractFacade
{

    /**
     * @return FilterBuilder
     */
    protected static function getInstance(): FilterBuilder
    {
        return FilterBuilder::getInstance();
    }

}