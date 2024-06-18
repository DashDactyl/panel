<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Servers;

use DASHDACTYL\Models\Server;
use DASHDACTYL\Transformers\Api\Application\ServerTransformer;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;
use DASHDACTYL\Http\Requests\Api\Application\Servers\GetExternalServerRequest;

class ExternalServerController extends ApplicationApiController
{
    /**
     * Retrieve a specific server from the database using its external ID.
     */
    public function index(GetExternalServerRequest $request, string $external_id): array
    {
        $server = Server::query()->where('external_id', $external_id)->firstOrFail();

        return $this->fractal->item($server)
            ->transformWith(ServerTransformer::class)
            ->toArray();
    }
}