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
     * @inheritdoc
     */
    protected function runDefault(string $hook, $args)
    {
        return apply_filters($hook, $args);
    }

    /**
     * @inheritdoc
     */
    protected function runWithRefArray(string $hook, array $args = [])
    {
        return apply_filters_ref_array($hook, $args);
    }

    /**
     * @inheritdoc
     */
    protected function registerHook(string $hookName, $callback, ?int $priority, ?int $acceptedArgs): void
    {
        add_filter($hookName, $callback, $priority, $acceptedArgs);
    }

    /**
     * @inheritdoc
     */
    protected function removeHook(string $hookName, $callback, ?int $priority = null): void
    {
        remove_filter($hookName, $callback, $priority);
    }
}
