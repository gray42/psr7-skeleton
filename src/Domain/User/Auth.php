<?php

namespace App\Domain\User;

use App\Domain\Service\ServiceInterface;
use Odan\Session\SessionInterface;
use RuntimeException;

/**
 * Authentication and authorisation.
 */
final class Auth implements ServiceInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var AuthRepository
     */
    private $authRepository;

    /**
     * Constructor.
     *
     * @param SessionInterface $session The session storage
     * @param AuthRepository $authRepository The repository
     */
    public function __construct(SessionInterface $session, AuthRepository $authRepository)
    {
        $this->session = $session;
        $this->authRepository = $authRepository;
    }

    /**
     * Check if a user is logged in.
     *
     * @return bool Status
     */
    public function check(): bool
    {
        return !empty($this->session->get('user'));
    }

    /**
     * Destroy the current logged in user session.
     *
     * @return void
     */
    public function logout(): void
    {
        $this->session->remove('user');

        // Clears all session data and regenerates session ID
        if ($this->session->isStarted()) {
            //$this->session->regenerateId();
            $this->session->destroy();
        }
    }

    /**
     * Get user ID.
     *
     * @throws RuntimeException
     *
     * @return int the user ID
     */
    public function getUserId(): int
    {
        $result = $this->getUser()->getId();

        if (empty($result)) {
            throw new RuntimeException(__('Invalid or empty User-ID'));
        }

        return $result;
    }

    /**
     * Retrieves the currently logged in user.
     *
     *@throws RuntimeException
     *
     * @return UserData The logged-in user
     */
    public function getUser(): UserData
    {
        $user = $this->session->get('user');

        if (!$user) {
            throw new RuntimeException('No user available');
        }

        return $user;
    }

    /**
     * Performs an authentication attempt.
     *
     * @param string $username The username
     * @param string $password The password
     *
     * @return UserData|null The user or null
     */
    public function authenticate(string $username, string $password): ?UserData
    {
        $userRow = $this->authRepository->findUserByUsername($username);

        if (!$userRow) {
            return null;
        }

        $user = UserData::fromArray($userRow);

        if (!$this->verifyPassword($password, $user->getPassword() ?: '')) {
            return null;
        }

        $this->startUserSession($user);

        return $user;
    }

    /**
     * Returns true if password and hash is valid.
     *
     * @param string $password The password
     * @param string $hash The stored password hash
     *
     * @return bool Success
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Init user session.
     *
     * @param UserData $user The user
     *
     * @return void
     */
    private function startUserSession(UserData $user): void
    {
        // Clear session data
        $this->session->destroy();
        $this->session->start();

        // Create new session id
        $this->session->regenerateId();

        // Store user settings in session
        $this->setIdentity($user);
    }

    /**
     * Set the identity into storage or null if no identity is available.
     *
     * @param UserData $user The user
     *
     * @return void
     */
    private function setIdentity(UserData $user): void
    {
        $this->session->set('user', $user);
    }

    /**
     * Generate a secure password hash.
     *
     * @param string $password The password
     *
     * @return string
     */
    public function createPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT) ?: '';
    }

    /**
     * Check whether the user has the given role.
     *
     * @param string $role The role, e.g. UserRole::ROLE_ADMIN
     *
     * @return bool True if the given role is assigned to the user
     */
    public function hasRole(string $role): bool
    {
        return $this->getUser()->getRole() === $role;
    }

    /**
     * Check whether the user has at least one of the given roles.
     *
     * Accepts an array with roles and returns true if at least one of the roles
     * in the array is assigned to the user.
     *
     * @param array $roles The roles to check for, e.g. [UserRole::ROLE_ADMIN, UserRole::ROLE_USER]
     *
     * @return bool Status
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->getUser()->getRole(), $roles, true);
    }

    /**
     * Checks whether the user is an admin.
     *
     * @return bool Status
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(UserRoleType::ROLE_ADMIN);
    }
}
