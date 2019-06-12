<?php

namespace App\Domain\User;

use App\Domain\Service\ServiceInterface;

/**
 * Service.
 */
final class UserService implements ServiceInterface
{
    /**
     * @var UserRepositoryInterface|UserRepository
     */
    private $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepository The repository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Find all users.
     *
     * @return UserData[] A list of users
     */
    public function findAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    /**
     * Get user by ID.
     *
     * @param int $userId The user ID
     *
     * @return UserData The user
     */
    public function getUserById(int $userId): UserData
    {
        return $this->userRepository->getUserById($userId);
    }

    /**
     * Register new user.
     *
     * @param UserData $user The user
     *
     * @return int The new ID
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
