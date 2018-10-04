<?php

declare(strict_types=1);


namespace App\Data\Settlement;


use App\Component\Repository\Repository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Exception;

class SettlementRepository extends Repository
{
    /**
     * RealizationRepository constructor.
     * @param SettlementFactory $factory
     */
    public function __construct(
        SettlementFactory $factory
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
        return Settlement::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Settlement|null
     */
    public function findById($id, array $with = []): ?Settlement
    {
        try {
            if (count($with) == 0) {
                return Settlement::find($id);
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
        return Settlement::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    public function findToday(): Collection
    {
        return $this->find(['transaction_at' => Carbon::now()->toDateString()]);
    }

    /**
     * @param array $payload
     * @return Settlement
     */
    public function create(array $payload): Settlement
    {
        $realization = $this->factory->create($payload);
        $realization->save();

        return $realization;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Settlement
     */
    public function update($id, array $payload): Settlement
    {
        $realization = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $realization->save();

        return $realization;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Settlement::destroy($id);
    }
}