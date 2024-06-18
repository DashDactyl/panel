<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Roles;

use DASHDACTYL\Models\AdminRole;

class UpdateRoleRequest extends StoreRoleRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? AdminRole::getRulesForUpdate($this->route()->parameter('role'));
    }
}