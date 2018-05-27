<?php


namespace App\Http\Repositories;


interface Repository
{
    public function all();

    public function findById($id);

    public function create(array $params);

    public function update($id, array $params);

    public function destroy($id);
}