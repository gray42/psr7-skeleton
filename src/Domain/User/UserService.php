<?php

namespace App\Domain\User;

use App\Domain\Service\ServiceInterface;

/**
 * Service.
 */
final class UserService implements ServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepository $userRepository The repository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Find all users.
     *
     * @return UserData[] Array of users
     */
    public function findAllUsers(): array
    {
        $result = [];

        foreach ($this->userRepository->findAll() as $row) {
            $result[] = UserData::fromArray($row);
        }

        return $result;
    }

    /**
     * Get user by ID.
     *
     * @param int $userId The user ID
     *
     * @return UserData The data
     */
    public function getUserById(int $userId): UserData
    {
        $row = $this->userRepository->getUserById($userId);

        return UserData::fromArray($row);
    }

    /**
     * Register new user.
     *
     * @param UserData $user The user
     *
     * @return int New ID
     */
    public function registerUser(UserData $user): int
    {
        $row = [
            'username' => $user->getUsername(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'locale' => $user->getLocale(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'enabled' => $user->getEnabled() ? 1 : 0,
        ];

        return $this->userRepository->insertUser($row);
    }

    /**
     * Delete user.
     *
     * @param int $userId The user ID
     *
     * @return bool Success
     */
    public function unregisterUser(int $userId): bool
    {
        return $this->userRepository->deleteUser($userId);
    }
}
