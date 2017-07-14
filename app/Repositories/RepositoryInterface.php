<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
    * Get all.
    *
    * @return mixed
    */
    public function findAll();
    /**
     * Find or fail.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findOrFail(int $id);
    /**
     * Create.
     *
     * @param $data
     *
     * @return mixed
     */
    public function create(array $data);
}