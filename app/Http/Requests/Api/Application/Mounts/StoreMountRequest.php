<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Mounts;

use DASHDACTYL\Models\Mount;
use DASHDACTYL\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreMountRequest extends ApplicationApiRequest
{
    public function rules(array $rules = null): array
    {
        return $rules ?? Mount::getRules();
    }
}