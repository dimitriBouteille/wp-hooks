<?php

namespace Dbout\WpHook\Support;

use Dbout\WpHook\Builder\FilterBuilder;

/**
 * Class Filter
 * @package Dbout\WpHook\Support
 *
 * @method static FilterBuilder add(string|array $names, \Closure|string|array $callback, int $priority = 10, int $acceptedArgs = 3)
 * @method static FilterBuilder run(string $hook, $args = null)
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Filter extends AbstractSupport
{

    /**
     * @return FilterBuilder
     */
    protected static function getInstance(): FilterBuilder
    {
        return FilterBuilder::getInstance();
    }

}