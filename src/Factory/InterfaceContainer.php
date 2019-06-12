<?php

namespace App\Factory;

use League\Container\ReflectionContainer;

/**
 * Fallback container resolver for interfaces.
 */
class InterfaceContainer extends ReflectionContainer
{
    /**
     * {@inheritdoc}
     */
    public function get($id, array $args = [])
    {
        return parent::get(str_replace('Interface', '', $id));
    }

    /**
     * {@inheritdoc}
     */
    public function has($id): bool
    {
        return class_exists(str_replace('Interface', '', $id));
    }
}
