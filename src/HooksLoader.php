<?php

namespace Dbout\WpHook;

use Dbout\WpHook\Builder\ActionBuilder;
use Dbout\WpHook\Exception\HookException;
use Dbout\WpHook\Hookable\HookableInterface;

/**
 * Class HooksLoader
 * @package Dbout\WpHook
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class HooksLoader
{

    /**
     * Contains all hook class to be loaded
     *
     * @var string[]
     */
    private $hooks = [];

    /**
     * HooksLoader constructor.
     * @param array $classNames
     * @throws HookException
     */
    public function __construct(array $classNames = [])
    {
        $this->add($classNames);
    }

    /**
     * Add new hook class
     *
     * @param array|string $classNames
     * @return $this
     * @throws HookException
     */
    public function add($classNames): self
    {
        $classNames = (array)$classNames;

        foreach ($classNames as $name) {
            if(in_array($name, $this->hooks)) {
                throw new HookException(sprintf('Class %s already exist.', $name));
            }

            $this->hooks[] = $name;
        }

        return $this;
    }

    /**
     * @throws HookException
     * @throws \ReflectionException
     */
    public function register(): void
    {
        $builder = ActionBuilder::getInstance();
        foreach ($this->hooks as $hook) {

            $class = new \ReflectionClass($hook);
            if (!$class->isSubclassOf(HookableInterface::class)) {
                throw new HookException(sprintf('Class %s must implement class %s.', $hook, HookableInterface::class));
            }

            /** @var HookableInterface $instance */
            $instance = $class->newInstanceWithoutConstructor();
            if (empty($instance->getHookName())) {
                $instance->execute();
            } else {
                $builder->add((array)$instance->getHookName(), [$instance, 'execute'], $instance->getPriority());
            }

        }

    }

}