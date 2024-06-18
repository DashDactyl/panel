<?php

namespace DASHDACTYL\Contracts\Criteria;

use Illuminate\Database\Eloquent\Model;
use DASHDACTYL\Repositories\Repository;

interface CriteriaInterface
{
    /**
     * Apply selected criteria to a repository call.
     */
    public function apply(Model $model, Repository $repository): mixed;
}