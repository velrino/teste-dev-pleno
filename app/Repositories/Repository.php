<?php

namespace App\Repositories;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function findAll()
    {
        return $this->model->all();
    }

    public function findOrFail(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}