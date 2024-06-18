<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Roles;

use DASHDACTYL\Models\AdminRole;
use DASHDACTYL\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreRoleRequest extends ApplicationApiRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? AdminRole::getRules();
    }
}