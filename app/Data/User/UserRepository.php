<?php


namespace App\Data\User;

use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

/**
 * Class UserRepository
 * @package App\Data\User
 */
class UserRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param UserFactory $factory
     */
    public function __construct(
        UserFactory $factory
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
        return User::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return User|null
     */
    public function findById($id, array $with = []): ?User
    {
        try {
            if (count($with) == 0) {
                return User::find($id);
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
        return User::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return User
     */
    public function create(array $payload): User
    {
        $user = $this->factory->create($payload);
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @param array $payload
     * @return User
     */
    public function update($id, array $payload): User
    {
        $user = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return User::destroy($id);
    }
}