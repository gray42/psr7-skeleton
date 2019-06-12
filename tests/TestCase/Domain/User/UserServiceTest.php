<?php

namespace App\Test\TestCase\Domain\User;

use App\Domain\User\UserData;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\UserService;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\DbTestCase;

/**
 * Tests.
 *
 * @coversDefaultClass \App\Domain\User\UserService
 */
class UserServiceTest extends DbTestCase
{
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
        $this->getContainer()->add(UserRepositoryInterface::class, UserMemoryRepository::class);

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
        $service = $this->createService();
        $actual = $service->getUserById(1);

        $fixture = new UserFixture();
        $expected = UserData::fromArray($fixture->records[0]);

        $this->assertEquals($expected, $actual);
    }
}
