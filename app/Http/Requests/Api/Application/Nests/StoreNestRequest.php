<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Nests;

use DASHDACTYL\Models\Nest;
use DASHDACTYL\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreNestRequest extends ApplicationApiRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? Nest::getRules();
    }
}