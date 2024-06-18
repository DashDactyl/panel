<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Files;

use DASHDACTYL\Models\Permission;
use DASHDACTYL\Contracts\Http\ClientPermissionsRequest;
use DASHDACTYL\Http\Requests\Api\Client\ClientApiRequest;

class DeleteFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_DELETE;
    }

    public function rules(): array
    {
        return [
            'root' => 'required|nullable|string',
            'files' => 'required|array',
            'files.*' => 'string',
        ];
    }
}