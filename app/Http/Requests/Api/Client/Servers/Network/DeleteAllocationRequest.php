<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Network;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class DeleteAllocationRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_ALLOCATION_DELETE;
    }
}