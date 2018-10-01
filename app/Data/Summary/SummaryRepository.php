<?php

declare(strict_types=1);


namespace App\Data\Summary;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

class SummaryRepository extends Repository
{
    /**
     * SummaryRepository constructor.
     * @param SummaryFactory $factory
     */
    public function __construct(
        SummaryFactory $factory
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
        return Summary::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Summary|null
     */
    public function findById($id, array $with = []): ?Summary
    {
        try {
            if (count($with) == 0) {
                return Summary::find($id);
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
        return Summary::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return Summary
     */
    public function create(array $payload): Summary
    {
        $summary = $this->factory->create($payload);
        $summary->save();

        return $summary;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Summary
     */
    public function update($id, array $payload): Summary
    {
        $summary = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $summary->save();

        return $summary;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Summary::destroy($id);
    }
}