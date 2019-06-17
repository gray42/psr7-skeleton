<?php

namespace App\Test\TestCase\Domain\User;

use App\Domain\User\UserData;
use App\Domain\User\UserRepository;
use App\Domain\User\UserService;
use App\Test\Fixture\UserFixture;
use App\Test\TestCase\UnitTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 *
 * @coversDefaultClass \App\Domain\User\UserService
 */
class UserServiceTest extends TestCase
{
    use UnitTestTrait;

    /**
     * Create repository.
     *
     * @return UserService The service
     */
    protected function createService(): UserService
    {
        // Mock all used repositories
        $this->registerMock(UserRepository::class);

        return $this->createInstance(UserService::class);
    }

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

        $this->mockMethod([UserRepository::class, 'findAll'])->willReturn([new UserData()]);

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

        $this->mockMethod([UserRepository::class, 'getUserById'])->willReturn($expected);

        $actual = $service->getUserById(1);
        $this->assertEquals($expected, $actual);
    }
}
