<?php

namespace App\Test\TestCase\Domain\User;

use App\Domain\User\UserData;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\UserService;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\ContainerTestTrait;
use App\Test\TestCase\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Tests.
 *
 * @coversDefaultClass \App\Domain\User\UserService
 */
class UserServiceTest extends UnitTestCase
{
    use ContainerTestTrait;

    /**
     * Create repository.
     *
     * @return UserService The service
     */
    protected function createService(): UserService
    {
        // Set container mock definition (alias).
        // More infos: Using IoC for Unit Testing
        // - https://stackoverflow.com/a/1465896/1461181
        // - https://stackoverflow.com/a/2102104/1461181
        $container = $this->getContainer();

        // Using an in-memory repository
        //$container->add(UserRepositoryInterface::class, UserMemoryRepository::class);

        // Mocking the interface
        $container->add(
            UserRepositoryInterface::class,
            $this->getMockedInterface(UserRepositoryInterface::class)
        );

        return $this->createInstance(UserService::class);
    }

    /**
     * Fixtures.
     *
     * @var array
     */
    public $fixtures = [
        UserFixture::class,
    ];

    /**
     * Test.
     *
     * @covers ::findAllUsers
     *
     * @return void
     */
    public function testFindAll(): void
    {
        $service = $this->createService();

        /** @var MockObject $mock */
        $mock = $this->getContainer()->get(UserRepositoryInterface::class);
        $mock->method('findAll')->willReturn([new UserData()]);

        $actual = $service->findAllUsers();

        $this->assertNotEmpty($actual);
    }

    /**
     * Test.
     *
     * @covers ::getUserById
     *
     * @return void
     */
    public function testGetUserById(): void
    {
        $fixture = new UserFixture();
        $expected = UserData::fromArray($fixture->records[0]);

        $service = $this->createService();

        /** @var MockObject $mock */
        $mock = $this->getContainer()->get(UserRepositoryInterface::class);
        $mock->method('getUserById')->willReturn($expected);

        $actual = $service->getUserById(1);
        $this->assertEquals($expected, $actual);
    }
}