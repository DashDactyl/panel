<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Servers;

use DASHDACTYL\Models\User;
use DASHDACTYL\Models\Server;
use DASHDACTYL\Services\Servers\StartupModificationService;
use DASHDACTYL\Transformers\Api\Application\ServerTransformer;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;
use DASHDACTYL\Http\Requests\Api\Application\Servers\UpdateServerStartupRequest;

class StartupController extends ApplicationApiController
{
    /**
     * StartupController constructor.
     */
    public function __construct(private StartupModificationService $modificationService)
    {
        parent::__construct();
    }

    /**
     * Update the startup and environment settings for a specific server.
     *
     * @throws \Throwable
     */
    public function index(UpdateServerStartupRequest $request, Server $server): array
    {
        $server = $this->modificationService
            ->setUserLevel(User::USER_LEVEL_ADMIN)
            ->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith(ServerTransformer::class)
            ->toArray();
    }
}