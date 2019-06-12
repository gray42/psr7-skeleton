<?php

namespace App\Test\TestCase\Domain\User;

use App\Domain\User\UserData;
use App\Domain\User\UserRepositoryInterface;
use App\Test\Fixture\UserFixture;
use DomainException;
use InvalidArgumentException;

/**
 * Mock.
 */
final class UserMemoryRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    private $rows = [];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $fixture = new UserFixture();

        foreach ($fixture->records as $row) {
            $this->rows[$row['id']] = UserData::fromArray($row);
        }
    }

    /**
     * Find all users.
     *
     * @return UserData[] A list of users
     */
    public function findAll(): array
    {
        return $this->rows;
    }

    /**
     * Get user by id.
     *
     * @param int $userId The User ID
     *
     * @throws DomainException
     *
     * @return UserData The user
     */
    public function getUserById(int $userId): UserData
    {
        if (!isset($this->rows[$userId])) {
            throw new DomainException(__('User not found: %s', $userId));
        }

        return $this->rows[$userId];
    }

    /**
     * Find by id.
     *
     * @param int $userId The user ID
     *
     * @return UserData The user
     */
    public function findUserById(int $userId): UserData
    {
        return $this->rows[$userId];
    }

    /**
     * Update user.
     *
     * @param int $userId The user ID
     * @param array $data The user data
     *
     * @throws InvalidArgumentException
     *
     * @return bool Success
     */
    public function updateUser(int $userId, array $data): bool
    {
        $this->rows[$userId] += $data;

        return true;
    }

    /**
     * Insert new user.
     *
     * @param array $data The user
     *
     * @return int The new ID
     */
    public function insertUser(array $data): int
    {
        $data['id'] = (int)count($this->rows);
        $this->rows[] = UserData::fromArray($data);

        return $data['id'];
    }

    /**
     * Delete user.
     *
     * @param int $userId The user ID
     *
     * @return bool Success
     */
    public function deleteUser(int $userId): bool
    {
        unset($this->rows[$userId]);

        return true;
    }
}
