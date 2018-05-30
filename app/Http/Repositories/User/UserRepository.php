<?php


namespace App\Http\Repositories\User;


use App\Http\Repositories\Repository;
use App\Models\User;

class UserRepository implements Repository
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function all()
    {
        return $this->user->get()
            ->toArray();
    }

    public function findById($id)
    {
        return $this->user->find($id);
    }

    public function create(array $params)
    {
        return $this->user->create($params);
    }

    public function update($id, array $params)
    {
        return $this->user->find($id)
            ->update($params);
    }

    public function destroy($id)
    {
        $user = $this->user->find($id);
        return $user->delete();
    }

}