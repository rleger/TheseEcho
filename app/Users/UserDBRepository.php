<?php

namespace These\Users;

use These\User;
use These\BaseRepository;

class UserDBRepository extends BaseRepository implements UserRepository
{
    /**
     * Constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function findByUsername($username)
    {
        return $this->entity->where('username', $username)->first();
    }

    public function findByUserRole($userRole)
    {
        return $this->entity->where('role', $userRole);
    }
}
