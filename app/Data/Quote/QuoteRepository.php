<?php


namespace App\Data\Quote;


use App\Component\Repository\Repository;
use Illuminate\Support\Collection;
use Exception;

class QuoteRepository extends Repository
{
    /**
     * QuoteRepository constructor.
     * @param QuoteFactory $factory
     */
    public function __construct(
        QuoteFactory $factory
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
        return Quote::with($with)
            ->orderBy('code')
            ->get();
    }

    /**
     * @param $id
     * @param array $with
     * @return Quote|null
     */
    public function findById($id, array $with = []): ?Quote
    {
        try {
            if (count($with) == 0) {
                return Quote::find($id);
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
        return Quote::where($condition)
            ->with($with)
            ->orderBy('code')
            ->get();
    }

    /**
     * @param array $payload
     * @return Quote
     */
    public function create(array $payload): Quote
    {
        $quote = $this->factory->create($payload);
        $quote->save();

        return $quote;
    }

    /**
     * @param $id
     * @param array $payload
     * @return Quote
     */
    public function update($id, array $payload): Quote
    {
        $quote = $this->factory->update(
            $this->findById($id),
            $payload
        );
        $quote->save();

        return $quote;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Quote::destroy($id);
    }
}