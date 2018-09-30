<?php

declare(strict_types=1);


namespace App\Data\UserAccount;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

/**
 * Class UserAccountRepository
 * @package App\Data\UserAccount
 */
class UserAccountRepository extends Repository
{
    /**
     * UserAccountRepository constructor.
     * @param UserAccountFactory $factory
     */
    public function __construct(
        UserAccountFactory $factory
    )
    {
        $this->factory = $factory;
    }

    /**
     * @param array $with
     * @return Collection
     */
    public function all(array $with = []): Collection
    {
        return UserAccount::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return UserAccount|null
     */
    public function findById($id, array $with = []): ?UserAccount
    {
        try {
            if (count($with) == 0) {
                return UserAccount::find($id);
            }

            return $this->find(['id' => $id], $with)
                ->first();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param array $condition
     * @param array $with
     * @return Collection
     */
    public function find(array $condition, array $with = []): Collection
    {
        return UserAccount::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return UserAccount
     */
    public function create(array $payload): UserAccount
    {
        $userAccount = $this->factory->create($payload);
        $userAccount->save();

        return $userAccount;
    }

    /**
     * @param $id
     * @param array $payload
     * @return UserAccount
     */
    public function update($id, array $payload): UserAccount
    {
        $userAccount = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $userAccount->save();

        return $userAccount;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return UserAccount::destroy($id);
    }
}