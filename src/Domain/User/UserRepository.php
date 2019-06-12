<?php

namespace App\Domain\User;

use App\Repository\QueryFactory;
use App\Repository\TableRepository;
use DomainException;
use InvalidArgumentException;

/**
 * Repository.
 */
final class UserRepository implements UserRepositoryInterface
{
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    /**
     * @var TableRepository
     */
    private $tableRepository;

    /**
     * Constructor.
     *
     * @param QueryFactory $queryFactory The query factory
     * @param TableRepository $tableRepository The table repository
     */
    public function __construct(QueryFactory $queryFactory, TableRepository $tableRepository)
    {
        $this->queryFactory = $queryFactory;
        $this->tableRepository = $tableRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $result = [];

        foreach ($this->tableRepository->fetchAll('users') as $row) {
            $result[] = UserData::fromArray($row);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserById(int $userId): UserData
    {
        $result = $this->findUserById($userId);

        if (!$result) {
            throw new DomainException(__('User not found: %s', $userId));
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function findUserById(int $userId): ?UserData
    {
        $row = $this->tableRepository->fetchById('users', $userId);

        return $row ? UserData::fromArray($row) : null;
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
        if (empty($userId)) {
            throw new InvalidArgumentException('User ID required');
        }

        $this->queryFactory->newUpdate('users', $data)->andWhere(['id' => $data['id']])->execute();

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function insertUser(array $data): int
    {
        return (int)$this->queryFactory->newInsert('users', $data)->execute()->lastInsertId();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteUser(int $userId): bool
    {
        $this->queryFactory->newDelete('users')->andWhere(['id' => $userId])->execute();

        return true;
    }
}
