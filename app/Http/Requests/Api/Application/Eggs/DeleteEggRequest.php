<?php

namespace DASHDACTYL\Http\Requests\Api\Application\Eggs;

use DASHDACTYL\Models\Egg;
use DASHDACTYL\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteEggRequest extends ApplicationApiRequest
{
    public function resourceExists(): bool
    {
        $egg = $this->route()->parameter('egg');

        return $egg instanceof Egg && $egg->exists;
    }
}