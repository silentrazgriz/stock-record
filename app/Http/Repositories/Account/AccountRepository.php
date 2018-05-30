<?php


namespace App\Http\Repositories\Account;


use App\Http\Repositories\Repository;
use App\Models\Account;

class AccountRepository implements Repository
{
    private $account;

    public function __construct()
    {
        $this->account = new Account();
    }

    public function all()
    {
        return $this->account->get()
            ->toArray();
    }

    public function findById($id)
    {
        return $this->account->find($id);
    }

    public function create(array $params)
    {
        return $this->account->create($params);
    }

    public function update($id, array $params)
    {
        return $this->account->find($id)
            ->update($params);
    }

    public function destroy($id)
    {
        $account = $this->account->find($id);
        return $account->delete();
    }

}