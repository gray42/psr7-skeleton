<?php

namespace App\Test\TestCase;

use League\Container\Container;
use Monolog\Handler\NullHandler;
use Monolog\Logger;
use Odan\Session\PhpSession;
use Odan\Session\SessionInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;
use ReflectionClass;
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
     * @return Container
     */
    protected function getContainer(): Container
    {
        if ($this->container === null) {
            throw new RuntimeException('Container must be initialized');
        }

        $this->container->share(SessionInterface::class, static function () {
            $session = new PhpSession();
            $session->setOptions([
                'cache_expire' => 60,
                'name' => 'app',
                'use_cookies' => false,
                'cookie_httponly' => false,
            ]);

            return $session;
        });

        $this->container->share(LoggerInterface::class, static function () {
            $logger = new Logger('test');

            return $logger->pushHandler(new NullHandler());
        });

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

    /**
     * Mocking an interface.
     *
     * @param string $interface The interface / class name
     *
     * @return MockObject The mock
     */
    protected function getMockedInterface(string $interface): MockObject
    {
        $reflection = new ReflectionClass($interface);

        $methods = [];
        foreach ($reflection->getMethods() as $method) {
            $methods[] = $method->name;
        }

        return $this->getMockBuilder($interface)
            ->setMethods($methods)
            ->getMock();
    }
}
