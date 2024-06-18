<?php

namespace DASHDACTYL\Transformers\Api\Application;

use DASHDACTYL\Models\EggVariable;
use DASHDACTYL\Models\ServerVariable;
use DASHDACTYL\Transformers\Api\Transformer;

class ServerVariableTransformer extends Transformer
{
    /**
     * Return the resource name for the JSONAPI output.
     */
    public function getResourceName(): string
    {
        return ServerVariable::RESOURCE_NAME;
    }

    /**
     * Return a generic transformed server variable array.
     */
    public function transform(EggVariable $model): array
    {
        return $model->toArray();
    }
}