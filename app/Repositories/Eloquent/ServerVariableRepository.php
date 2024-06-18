<?php

namespace DASHDACTYL\Repositories\Eloquent;

use DASHDACTYL\Models\ServerVariable;
use DASHDACTYL\Contracts\Repository\ServerVariableRepositoryInterface;

class ServerVariableRepository extends EloquentRepository implements ServerVariableRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return ServerVariable::class;
    }
}