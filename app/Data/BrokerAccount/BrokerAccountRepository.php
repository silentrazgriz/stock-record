<?php


namespace App\Data\BrokerAccount;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

/**
 * Class AccountRepository
 * @package App\Data\Account
 */
class BrokerAccountRepository extends Repository
{
    /**
     * AccountRepository constructor.
     * @param BrokerAccountFactory $factory
     */
    public function __construct(
        BrokerAccountFactory $factory
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
        return BrokerAccount::with($with)
            ->orderBy('code')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return BrokerAccount|null
     */
    public function findById($id, array $with = []): ?BrokerAccount
    {
        try {
            if (count($with) == 0) {
                return BrokerAccount::find($id);
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
        return BrokerAccount::where($condition)
            ->with($with)
            ->orderBy('code')
            ->get();
    }

    /**
     * @param array $payload
     * @return BrokerAccount
     */
    public function create(array $payload): BrokerAccount
    {
        $account = $this->factory->create($payload);
        $account->save();

        return $account;
    }

    /**
     * @param $id
     * @param array $payload
     * @return BrokerAccount
     */
    public function update($id, array $payload): BrokerAccount
    {
        $account = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $account->save();

        return $account;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return BrokerAccount::destroy($id);
    }
}