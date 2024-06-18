<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Locations;

use Illuminate\Http\Response;
use DASHDACTYL\Models\Location;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use DASHDACTYL\Services\Locations\LocationUpdateService;
use DASHDACTYL\Services\Locations\LocationCreationService;
use DASHDACTYL\Services\Locations\LocationDeletionService;
use DASHDACTYL\Transformers\Api\Application\LocationTransformer;
use DASHDACTYL\Exceptions\Http\QueryValueOutOfRangeHttpException;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;
use DASHDACTYL\Http\Requests\Api\Application\Locations\GetLocationRequest;
use DASHDACTYL\Http\Requests\Api\Application\Locations\GetLocationsRequest;
use DASHDACTYL\Http\Requests\Api\Application\Locations\StoreLocationRequest;
use DASHDACTYL\Http\Requests\Api\Application\Locations\DeleteLocationRequest;
use DASHDACTYL\Http\Requests\Api\Application\Locations\UpdateLocationRequest;

class LocationController extends ApplicationApiController
{
    /**
     * LocationController constructor.
     */
    public function __construct(
        private LocationCreationService $creationService,
        private LocationDeletionService $deletionService,
        private LocationUpdateService $updateService
    ) {
        parent::__construct();
    }

    /**
     * Return all the locations currently registered on the Panel.
     */
    public function index(GetLocationsRequest $request): array
    {
        $perPage = (int) $request->query('per_page', '10');
        if ($perPage < 1 || $perPage > 100) {
            throw new QueryValueOutOfRangeHttpException('per_page', 1, 100);
        }

        $locations = QueryBuilder::for(Location::query())
            ->allowedFilters(['short', 'long'])
            ->allowedSorts(['id', 'short', 'long'])
            ->paginate($perPage);

        return $this->fractal->collection($locations)
            ->transformWith(LocationTransformer::class)
            ->toArray();
    }

    /**
     * Return a single location.
     */
    public function view(GetLocationRequest $request, Location $location): array
    {
        return $this->fractal->item($location)
            ->transformWith(LocationTransformer::class)
            ->toArray();
    }

    /**
     * Store a new location on the Panel and return an HTTP/201 response code with the
     * new location attached.
     *
     * @throws \DASHDACTYL\Exceptions\Model\DataValidationException
     */
    public function store(StoreLocationRequest $request): JsonResponse
    {
        $location = $this->creationService->handle($request->validated());

        return $this->fractal->item($location)
            ->transformWith(LocationTransformer::class)
            ->respond(201);
    }

    /**
     * Update a location on the Panel and return the updated record to the user.
     *
     * @throws \DASHDACTYL\Exceptions\Model\DataValidationException
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function update(UpdateLocationRequest $request, Location $location): array
    {
        $location = $this->updateService->handle($location, $request->validated());

        return $this->fractal->item($location)
            ->transformWith(LocationTransformer::class)
            ->toArray();
    }

    /**
     * Delete a location from the Panel.
     *
     * @throws \DASHDACTYL\Exceptions\Service\Location\HasActiveNodesException
     */
    public function delete(DeleteLocationRequest $request, Location $location): Response
    {
        $this->deletionService->handle($location);

        return $this->returnNoContent();
    }
}