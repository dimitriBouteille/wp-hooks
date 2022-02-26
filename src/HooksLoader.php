<?php

namespace Dbout\WpHooks;

use Dbout\WpHooks\Builder\ActionBuilder;
use Dbout\WpHooks\Exception\HookException;
use Dbout\WpHooks\Hookable\HookableInterface;

/**
 * Class HooksLoader
 * @package Dbout\WpHooks
 *
 * @author Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @copyright Copyright (c) 2022
 */
class HooksLoader
{

    /**
     * Contains all hook class to be loaded
     * @var string[]
     */
    protected array $hooks = [];

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
     * @return void
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
