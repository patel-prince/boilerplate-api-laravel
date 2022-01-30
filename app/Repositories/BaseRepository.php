<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data)->fresh();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByOrFail($field, $value)
    {
        return $this->model->where($field, $value)->firstOrFail();
    }
}
