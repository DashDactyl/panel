<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Databases;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Contracts\Http\ClientPermissionsRequest;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class GetDatabasesRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_DATABASE_READ;
    }
}