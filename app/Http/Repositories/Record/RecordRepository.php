<?php


namespace App\Http\Repositories\Record;


use App\Http\Repositories\Repository;
use App\Models\Record;

class RecordRepository implements Repository
{
    private $record;

    public function __construct()
    {
        $this->record = new Record();
    }

    public function all()
    {
        return $this->record->get()
            ->toArray();
    }

    public function findById($id)
    {
        return $this->record->find($id);
    }

    public function create(array $params)
    {
        return $this->record->create($params);
    }

    public function update($id, array $params)
    {
        return $this->record->find($id)
            ->update($params);
    }

    public function destroy($id)
    {
        $record = $this->record->find($id);
        return $record->delete();
    }

}