<?php


namespace App\Data\Record;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

/**
 * Class RecordRepository
 * @package App\Data\Record
 */
class RecordRepository extends Repository
{
    /**
     * RecordRepository constructor.
     * @param RecordFactory $factory
     */
    public function __construct(
        RecordFactory $factory
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
        return Record::with($with)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Record|null
     */
    public function findById($id, array $with = []): ?Record
    {
        try {
            if (count($with) == 0) {
                return Record::find($id);
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
        return Record::where($condition)
            ->with($with)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param array $payload
     * @return Record
     */
    public function create(array $payload): Record
    {
        $record = $this->factory->create($payload);
        $record->save();

        return $record;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Record
     */
    public function update($id, array $payload): Record
    {
        $record = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $record->save();

        return $record;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Record::destroy($id);
    }
}