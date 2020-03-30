<?php

namespace Dbout\WpHook\Builder;

/**
 * Class FilterBuilder
 * @package Dbout\WpHook\Builder
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class FilterBuilder extends AbstractHookBuilder
{

    /**
     * @param string $hook
     * @param $args
     * @return mixed|void   The filtered value after all hooked functions are applied to it.
     */
    protected function runDefault(string $hook, $args)
    {
        return apply_filters($hook, $args);
    }

    /**
     * @param string $hook
     * @param array $args
     * @return mixed        The filtered value after all hooked functions are applied to it.
     */
    protected function runWithRefArray(string $hook, array $args = [])
    {
        return apply_filters_ref_array($hook, $args);
    }

    /**
     * @param string $hookName
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @return mixed|void
     */
    protected function registerHook(string $hookName, $callback, int $priority, int $acceptedArgs)
    {
        add_filter($hookName, $callback, $priority, $acceptedArgs);
    }

}