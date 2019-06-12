<?php

namespace App\Domain\User;

use App\Repository\RepositoryInterface;

/**
 * Interface.
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function findAll(): array;

    public function getUserById(int $userId): UserData;

    public function findUserById(int $userId): UserData;

    public function updateUser(int $userId, array $data): bool;

    public function insertUser(array $data): int;

    public function deleteUser(int $userId): bool;
}
