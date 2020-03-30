<?php

namespace Dbout\WpHook\Builder;

/**
 * Class ActionBuilder
 * @package Dbout\WpHook\Builder
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
     * @param string $hookName
     * @param $callback
     * @param int $priority
     * @param int $acceptedArgs
     * @return mixed|void
     */
    protected function registerHook(string $hookName, $callback, int $priority, int $acceptedArgs)
    {
        add_action($hookName, $callback, $priority, $acceptedArgs);
    }

}