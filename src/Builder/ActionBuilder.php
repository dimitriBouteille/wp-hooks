<?php

namespace Dbout\WpHooks\Builder;

/**
 * Class ActionBuilder
 * @package Dbout\WpHooks\Builder
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class ActionBuilder extends AbstractHookBuilder
{

    /**
     * Call do_action function
     * https://developer.wordpress.org/reference/functions/do_action/
     *
     * @param string $hook  Action name
     * @param mixed $args   Arguments
     */
    protected function runDefault(string $hook, $args): void
    {
        do_action($hook, $args);
    }

    /**
     * Call do_action_ref_array function
     * https://developer.wordpress.org/reference/functions/do_action_ref_array/
     *
     * @param string $hook  Action name
     * @param mixed $args   Arguments
     */
    protected function runWithRefArray(string $hook, array $args = []): void
    {
        do_action_ref_array($hook, $args);
    }

    /**
     * Call add_action function
     * https://developer.wordpress.org/reference/functions/add_action/
     *
     * @param string $hookName
     * @param $callback
     * @param int|null $priority
     * @param int|null $acceptedArgs
     * @return mixed|void
     */
    protected function registerHook(string $hookName, $callback, ?int $priority, ?int $acceptedArgs)
    {
        add_action($hookName, $callback, $priority, $acceptedArgs);
    }

    /**
     * Call remove_action function
     * https://developer.wordpress.org/reference/functions/remove_action/
     *
     * @param string $hookName
     * @param $callback
     * @param int|null $priority
     * @return mixed|void
     */
    protected function removeHook(string $hookName, $callback, ?int $priority = null)
    {
        remove_action($hookName, $callback, $priority);
    }

}