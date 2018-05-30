<?php


namespace App\Http\Repositories\Summary;


use App\Http\Repositories\Repository;
use App\Models\Summary;

class SummaryRepository implements Repository
{
    private $summary;

    public function __construct()
    {
        $this->summary = new Summary();
    }

    public function all()
    {
        return $this->summary->get()
            ->toArray();
    }

    public function findById($id)
    {
        return $this->summary->find($id);
    }

    public function create(array $params)
    {
        return $this->summary->create($params);
    }

    public function update($id, array $params)
    {
        return $this->summary->find($id)
            ->update($params);
    }

    public function destroy($id)
    {
        $summary = $this->summary->find($id);
        return $summary->delete();
    }

}