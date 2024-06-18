<?php

namespace DASHDACTYL\Transformers\Api\Application;

use DASHDACTYL\Models\AdminRole;
use DASHDACTYL\Transformers\Api\Transformer;

class AdminRoleTransformer extends Transformer
{
    /**
     * Return the resource name for the JSONAPI output.
     */
    public function getResourceName(): string
    {
        return AdminRole::RESOURCE_NAME;
    }

    /**
     * Transform admin role into a representation for the application API.
     */
    public function transform(AdminRole $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'description' => $model->description,
        ];
    }
}