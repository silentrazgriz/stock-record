<?php

declare(strict_types=1);


namespace App\Component\Repository;


/**
 * Class Repository
 * @package App\Component\Repository
 */
abstract class Repository
{
    protected $factory;

    /**
     * @param array $with
     * @return mixed
     */
    abstract public function all(array $with = []);

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    abstract public function findById($id, array $with = []);

    /**
     * @param array $condition
     * @param array $with
     * @return mixed
     */
    abstract public function find(array $condition, array $with = []);

    /**
     * @param array $payload
     * @return mixed
     */
    abstract public function create(array $payload);

    /**
     * @param $id
     * @param array $payload
     * @return mixed
     */
    abstract public function update($id, array $payload);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function destroy($id);
}