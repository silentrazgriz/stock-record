<?php


namespace App\Http\Repositories\Quote;


use App\Http\Repositories\Repository;
use App\Models\Quote;

class QuoteRepository implements Repository
{
    private $quote;

    public function __construct()
    {
        $this->quote = new Quote();
    }

    public function all()
    {
        return $this->quote->get()
            ->toArray();
    }

    public function findById($id)
    {
        return $this->quote->find($id);
    }

    public function create(array $params)
    {
        return $this->quote->create($params);
    }

    public function update($id, array $params)
    {
        return $this->quote->find($id)
            ->update($params);
    }

    public function destroy($id)
    {
        $quote = $this->quote->find($id);
        return $quote->delete();
    }

}