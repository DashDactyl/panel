<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Subusers;

use DASHDACTYL\Models\Permission;

class DeleteSubuserRequest extends SubuserRequest
{
    public function permission(): string
    {
        return Permission::ACTION_USER_DELETE;
    }
}