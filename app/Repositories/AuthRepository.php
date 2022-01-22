<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository extends BaseRepository
{
    private User $users;

    public function __construct(User $users)
    {
        $this->users = $users;
        parent::__construct($users);
    }

    public function markAsVerified($data)
    {
        $user = $this->users->where('email_verification_code', $data)->firstOrFail();
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->email_verification_code = null;
        $user->save();
        return $user->fresh();
    }
}
