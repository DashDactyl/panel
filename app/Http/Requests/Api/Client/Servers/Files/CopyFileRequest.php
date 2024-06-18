<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Files;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Contracts\Http\ClientPermissionsRequest;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class CopyFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }

    public function rules(): array
    {
        return [
            'location' => 'required|string',
        ];
    }
}