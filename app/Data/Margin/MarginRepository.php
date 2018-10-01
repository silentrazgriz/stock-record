<?php

declare(strict_types=1);


namespace App\Data\Margin;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

class MarginRepository extends Repository
{
    /**
     * MarginRepository constructor.
     * @param MarginFactory $factory
     */
    public function __construct(
        MarginFactory $factory
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
        return Margin::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Margin|null
     */
    public function findById($id, array $with = []): ?Margin
    {
        try {
            if (count($with) == 0) {
                return Margin::find($id);
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
        return Margin::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return Margin
     */
    public function create(array $payload): Margin
    {
        $margin = $this->factory->create($payload);
        $margin->save();

        return $margin;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Margin
     */
    public function update($id, array $payload): Margin
    {
        $margin = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $margin->save();

        return $margin;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Margin::destroy($id);
    }
}