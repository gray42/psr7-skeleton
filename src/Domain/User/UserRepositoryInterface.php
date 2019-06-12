<?php

namespace App\Domain\User;

use App\Repository\RepositoryInterface;
use DomainException;
use InvalidArgumentException;

/**
 * Interface.
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Find all users.
     *
     * @return UserData[] A list of users
     */
    public function findAll(): array;

    /**
     * Get user by id.
     *
     * @param int $userId The User ID
     *
     * @throws DomainException
     *
     * @return UserData The user
     */
    public function getUserById(int $userId): UserData;

    /**
     * Find by id.
     *
     * @param int $userId The user ID
     *
     * @return UserData|null The user
     */
    public function findUserById(int $userId): ?UserData;

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
    public function updateUser(int $userId, array $data): bool;

    /**
     * Insert new user.
     *
     * @param array $data The user
     *
     * @return int The new ID
     */
    public function insertUser(array $data): int;

    /**
     * Delete user.
     *
     * @param int $userId The user ID
     *
     * @return bool Success
     */
    public function deleteUser(int $userId): bool;
}
