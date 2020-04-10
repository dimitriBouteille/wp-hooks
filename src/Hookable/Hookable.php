<?php

namespace Dbout\WpHooks\Hookable;

/**
 * Class Hookable
 * @package Dbout\WpHooks\Hookable
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
abstract class Hookable implements HookableInterface
{

    /**
     * @var null|string
     */
    protected $hook = null;

    /**
     * Hook priority
     * https://developer.wordpress.org/reference/functions/add_action/
     *
     * @var int
     */
    protected $priority = 10;

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return string|null
     */
    public function getHookName(): ?string
    {
        return $this->hook;
    }

}