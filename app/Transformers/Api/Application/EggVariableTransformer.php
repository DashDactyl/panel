<?php

namespace DASHDACTYL\Transformers\Api\Application;

use DASHDACTYL\Models\Egg;
use DASHDACTYL\Models\EggVariable;
use DASHDACTYL\Transformers\Api\Transformer;

class EggVariableTransformer extends Transformer
{
    /**
     * Return the resource name for the JSONAPI output.
     */
    public function getResourceName(): string
    {
        return Egg::RESOURCE_NAME;
    }

    /**
     * Transform egg variable into a representation for the application API.
     */
    public function transform(EggVariable $model): array
    {
        return $model->toArray();
    }
}