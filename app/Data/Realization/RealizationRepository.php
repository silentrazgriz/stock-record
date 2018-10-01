<?php

declare(strict_types=1);


namespace App\Data\Realization;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

class RealizationRepository extends Repository
{
    /**
     * RealizationRepository constructor.
     * @param RealizationFactory $factory
     */
    public function __construct(
        RealizationFactory $factory
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
        return Realization::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Realization|null
     */
    public function findById($id, array $with = []): ?Realization
    {
        try {
            if (count($with) == 0) {
                return Realization::find($id);
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
        return Realization::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return Realization
     */
    public function create(array $payload): Realization
    {
        $realization = $this->factory->create($payload);
        $realization->save();

        return $realization;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Realization
     */
    public function update($id, array $payload): Realization
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
        return Realization::destroy($id);
    }
}