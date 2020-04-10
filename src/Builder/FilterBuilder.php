<?php

namespace Dbout\WpHooks\Builder;

/**
 * Class FilterBuilder
 * @package Dbout\WpHooks\Builder
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class FilterBuilder extends AbstractHookBuilder
{

    /**
     * Call apply_filters functions
     * https://developer.wordpress.org/reference/functions/apply_filters/
     *
     * @param string $hook
     * @param $args
     * @return mixed|void   The filtered value after all hooked functions are applied to it.
     */
    protected function runDefault(string $hook, $args)
    {
        return apply_filters($hook, $args);
    }

    /**
     * Call apply_filters_ref_array functions
     * https://developer.wordpress.org/reference/functions/apply_filters_ref_array/
     *
     * @param string $hook
     * @param array $args
     * @return mixed        The filtered value after all hooked functions are applied to it.
     */
    protected function runWithRefArray(string $hook, array $args = [])
    {
        return apply_filters_ref_array($hook, $args);
    }

    /**
     * Call add_filter function
     * https://developer.wordpress.org/reference/functions/add_filter/
     *
     * @param string $hookName
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @return mixed|void
     */
    protected function registerHook(string $hookName, $callback, ?int $priority, ?int $acceptedArgs)
    {
        add_filter($hookName, $callback, $priority, $acceptedArgs);
    }

    /**
     * Call remove_filter function
     * https://developer.wordpress.org/reference/functions/remove_filter/
     *
     * @param string $hookName
     * @param $callback
     * @param int|null $priority
     * @return mixed|void
     */
    protected function removeHook(string $hookName, $callback, ?int $priority = null)
    {
        remove_filter($hookName, $callback, $priority);
    }

}