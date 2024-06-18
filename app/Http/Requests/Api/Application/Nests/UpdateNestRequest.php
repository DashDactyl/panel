<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Nests;

use DASHDACTYL\Models\Nest;

class UpdateNestRequest extends StoreNestRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? Nest::getRulesForUpdate($this->route()->parameter('nest'));
    }
}