<?php

namespace Dbout\WpHooks\Facade;

use Dbout\WpHooks\Builder\FilterBuilder;

/**
 * Class Filter
 * @package Dbout\WpHooks\Facade
 *
 * @author Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @copyright Copyright (c) 2022
 *
 * @method static FilterBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static FilterBuilder run(string $hook, $args = null)
 * @method static FilterBuilder remove(string $hook, $callback = null, int $priority = 10)
 */
class Filter extends AbstractFacade
{

    /**
     * @inheritdoc
     */
    protected static function getInstance(): FilterBuilder
    {
        return FilterBuilder::getInstance();
    }
}
