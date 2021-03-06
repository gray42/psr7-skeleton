<?php

namespace App\Domain\User;

use App\Domain\Data\DataInterface;

/**
 * DTO containing User infos.
 */
final class UserData implements DataInterface
{
    /** @var int|null */
    private $id;

    /** @var string|null */
    private $username;

    /** @var string|null */
    private $password;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $firstName;

    /** @var string|null */
    private $lastName;

    /** @var string|null */
    private $role;

    /** @var string|null */
    private $locale;

    /** @var bool */
    private $enabled = false;

    /**
     * @return int|null The value
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id The value
     *
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null The value
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username The value
     *
     * @return void
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null The value
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password The value
     *
     * @return void
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null The value
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email The value
     *
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null The value
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName The value
     *
     * @return void
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null The value
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName The value
     *
     * @return void
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string|null The value
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role The value
     *
     * @return void
     */
    public function setRole(?string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string|null The value
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string|null $locale The value
     *
     * @return void
     */
    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return bool The value
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled The value
     *
     * @return void
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Crete data object from array.
     *
     * @param array $row The row data
     *
     * @return self The data object
     */
    public static function fromArray(array $row): self
    {
        $user = new self();

        $user->setId($row['id'] ?? null);
        $user->setUsername($row['username'] ?? null);
        $user->setFirstName($row['first_name'] ?? null);
        $user->setLastName($row['last_name'] ?? null);
        $user->setEmail($row['email'] ?? null);
        $user->setLocale($row['locale'] ?? null);
        $user->setPassword($row['password'] ?? null);
        $user->setRole($row['role'] ?? null);
        $user->setEnabled((bool)$row['enabled']);

        return $user;
    }
}
