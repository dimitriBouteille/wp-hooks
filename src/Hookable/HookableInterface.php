<?php

namespace Dbout\WpHooks\Hookable;

/**
 * Interface HookableInterface
 * @package Dbout\WpHooks\Hookable
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
interface HookableInterface
{

    /**
     * Get hook priority
     * https://developer.wordpress.org/reference/functions/add_action/
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get hook name
     * ie: init, after_setup_theme, ...
     *
     * @return string|null
     */
    public function getHookName(): ?string;

    /**
     * Function performed by the action
     * If you want get parameters, use func_get_args()
     *
     * @return void
     */
    public function execute(): void;

}