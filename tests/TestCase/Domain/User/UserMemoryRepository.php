<?php

namespace App\Test\TestCase\Domain\User;

use App\Domain\User\UserData;
use App\Domain\User\UserRepositoryInterface;
use App\Test\Fixture\UserFixture;
use DomainException;

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
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->rows;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserById(int $userId): UserData
    {
        if (!isset($this->rows[$userId])) {
            throw new DomainException(__('User not found: %s', $userId));
        }

        return $this->rows[$userId];
    }

    /**
     * {@inheritdoc}
     */
    public function findUserById(int $userId): ?UserData
    {
        return $this->rows[$userId];
    }

    /**
     * {@inheritdoc}
     */
    public function updateUser(int $userId, array $data): bool
    {
        $this->rows[$userId] += $data;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function insertUser(array $data): int
    {
        $data['id'] = (int)count($this->rows);
        $this->rows[] = UserData::fromArray($data);

        return $data['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function deleteUser(int $userId): bool
    {
        unset($this->rows[$userId]);

        return true;
    }
}
