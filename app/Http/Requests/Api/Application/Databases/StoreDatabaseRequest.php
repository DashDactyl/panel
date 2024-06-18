<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Databases;

use DASHDACTYL\Models\DatabaseHost;
use DASHDACTYL\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreDatabaseRequest extends ApplicationApiRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? DatabaseHost::getRules();
    }
}