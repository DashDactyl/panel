<?php

namespace DASHDACTYL\Repositories\Eloquent;

use DASHDACTYL\Models\User;
use DASHDACTYL\Contracts\Repository\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return User::class;
    }
}