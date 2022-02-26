<?php

namespace Dbout\WpHooks\Builder;

/**
 * Class ActionBuilder
 * @package Dbout\WpHooks\Builder
 *
 * @author Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @copyright Copyright (c) 2022
 */
class ActionBuilder extends AbstractHookBuilder
{

    /**
     * @inheritdoc
     */
    protected function runDefault(string $hook, $args): void
    {
        do_action($hook, $args);
    }

    /**
     * @inheritdoc
     */
    protected function runWithRefArray(string $hook, array $args = []): void
    {
        do_action_ref_array($hook, $args);
    }

    /**
     * @inheritdoc
     */
    protected function registerHook(string $hookName, $callback, ?int $priority, ?int $acceptedArgs): void
    {
        add_action($hookName, $callback, $priority, $acceptedArgs);
    }

    /**
     * @inheritdoc
     */
    protected function removeHook(string $hookName, $callback, ?int $priority = null): void
    {
        remove_action($hookName, $callback, $priority);
    }
}
