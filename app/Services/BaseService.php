<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class BaseService
{
    private BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findOrFail($id)
    {
        return $this->repository->findOrFail($id);
    }

    public function findByOrFail($field, $value)
    {
        return $this->repository->findByOrFail($field, $value);
    }
}
