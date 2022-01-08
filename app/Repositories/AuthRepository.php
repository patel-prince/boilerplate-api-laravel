<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository extends BaseRepository
{
    public function __construct(User $users)
    {
        parent::__construct($users);
    }
}
