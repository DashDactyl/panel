<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Databases;

use DASHDACTYL\Models\DatabaseHost;

class UpdateDatabaseRequest extends StoreDatabaseRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? DatabaseHost::getRulesForUpdate($this->route()->parameter('databaseHost'));
    }
}