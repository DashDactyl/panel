<?php

namespace DASHDACTYL\Repositories\Eloquent;

use DASHDACTYL\Models\RecoveryToken;

class RecoveryTokenRepository extends EloquentRepository
{
    public function model(): string
    {
        return RecoveryToken::class;
    }
}