<?php

namespace App\Test\TestCase;

use League\Container\Container;
use RuntimeException;

/**
 * Container Trait.
 */
trait ContainerTestTrait
{
    /** @var Container|null */
    protected $container;

    /**
     * Bootstrap app.
     *
     * @return void
     */
    protected function bootApp(): void
    {
        $this->container = require __DIR__ . '/../../config/bootstrap.php';
    }

    /**
     * Shutdown app.
     *
     * @return void
     */
    protected function shutdownApp(): void
    {
        $this->container = null;
    }

    /**
     * Get container.
     *
     * @throws RuntimeException
     *
     * @return Container The container
     */
    protected function getContainer(): Container
    {
        if ($this->container === null) {
            throw new RuntimeException('Container must be initialized');
        }

        return $this->container;
    }

    /**
     * Create a new instance.
     *
     * @param string $class The class name
     *
     * @return mixed The instance
     */
    protected function createInstance(string $class)
    {
        return $this->getContainer()->get($class);
    }
}
