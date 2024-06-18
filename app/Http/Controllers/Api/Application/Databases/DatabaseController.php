<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Databases;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use DASHDACTYL\Models\DatabaseHost;
use Spatie\QueryBuilder\QueryBuilder;
use DASHDACTYL\Services\Databases\Hosts\HostUpdateService;
use DASHDACTYL\Services\Databases\Hosts\HostCreationService;
use DASHDACTYL\Exceptions\Http\QueryValueOutOfRangeHttpException;
use DASHDACTYL\Transformers\Api\Application\DatabaseHostTransformer;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;
use DASHDACTYL\Http\Requests\Api\Application\Databases\GetDatabaseRequest;
use DASHDACTYL\Http\Requests\Api\Application\Databases\GetDatabasesRequest;
use DASHDACTYL\Http\Requests\Api\Application\Databases\StoreDatabaseRequest;
use DASHDACTYL\Http\Requests\Api\Application\Databases\DeleteDatabaseRequest;
use DASHDACTYL\Http\Requests\Api\Application\Databases\UpdateDatabaseRequest;

class DatabaseController extends ApplicationApiController
{
    /**
     * DatabaseController constructor.
     */
    public function __construct(private HostCreationService $creationService, private HostUpdateService $updateService)
    {
        parent::__construct();
    }

    /**
     * Returns an array of all database hosts.
     */
    public function index(GetDatabasesRequest $request): array
    {
        $perPage = (int) $request->query('per_page', '10');
        if ($perPage < 1 || $perPage > 100) {
            throw new QueryValueOutOfRangeHttpException('per_page', 1, 100);
        }

        $databases = QueryBuilder::for(DatabaseHost::query())
            ->allowedFilters(['name', 'host'])
            ->allowedSorts(['id', 'name', 'host'])
            ->paginate($perPage);

        return $this->fractal->collection($databases)
            ->transformWith(DatabaseHostTransformer::class)
            ->toArray();
    }

    /**
     * Returns a single database host.
     */
    public function view(GetDatabaseRequest $request, DatabaseHost $databaseHost): array
    {
        return $this->fractal->item($databaseHost)
            ->transformWith(DatabaseHostTransformer::class)
            ->toArray();
    }

    /**
     * Creates a new database host.
     *
     * @throws \Throwable
     */
    public function store(StoreDatabaseRequest $request): JsonResponse
    {
        $databaseHost = $this->creationService->handle($request->validated());

        return $this->fractal->item($databaseHost)
            ->transformWith(DatabaseHostTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }

    /**
     * Updates a database host.
     *
     * @throws \Throwable
     */
    public function update(UpdateDatabaseRequest $request, DatabaseHost $databaseHost): array
    {
        $databaseHost = $this->updateService->handle($databaseHost->id, $request->validated());

        return $this->fractal->item($databaseHost)
            ->transformWith(DatabaseHostTransformer::class)
            ->toArray();
    }

    /**
     * Deletes a database host.
     *
     * @throws \Exception
     */
    public function delete(DeleteDatabaseRequest $request, DatabaseHost $databaseHost): Response
    {
        $databaseHost->delete();

        return $this->returnNoContent();
    }
}