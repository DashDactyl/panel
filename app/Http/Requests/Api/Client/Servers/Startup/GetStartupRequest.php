<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Startup;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class GetStartupRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_STARTUP_READ;
    }
}