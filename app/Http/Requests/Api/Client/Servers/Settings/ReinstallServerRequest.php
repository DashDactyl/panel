<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Settings;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class ReinstallServerRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SETTINGS_REINSTALL;
    }
}