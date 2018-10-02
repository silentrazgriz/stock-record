<?php
declare(strict_types=1);


namespace App\Data\OffDay;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

class OffDayRepository extends Repository
{
    /**
     * OffDayRepository constructor.
     * @param OffDayFactory $factory
     */
    public function __construct(
        OffDayFactory $factory
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
        return OffDay::with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return OffDay|null
     */
    public function findById($id, array $with = []): ?OffDay
    {
        try {
            if (count($with) == 0) {
                return OffDay::find($id);
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
        return OffDay::where($condition)
            ->with($with)
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param array $payload
     * @return OffDay
     */
    public function create(array $payload): OffDay
    {
        $offDay = $this->factory->create($payload);
        $offDay->save();

        return $offDay;
    }

    /**
     * @param $id
     * @param array $payload
     * @return OffDay
     */
    public function update($id, array $payload): OffDay
    {
        $offDay = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $offDay->save();

        return $offDay;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return OffDay::destroy($id);
    }
}