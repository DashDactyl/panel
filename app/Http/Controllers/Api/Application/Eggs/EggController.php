<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Eggs;

use Ramsey\Uuid\Uuid;
use DASHDACTYL\Models\Egg;
use DASHDACTYL\Models\Nest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use DASHDACTYL\Services\Eggs\Sharing\EggExporterService;
use DASHDACTYL\Transformers\Api\Application\EggTransformer;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\GetEggRequest;
use DASHDACTYL\Exceptions\Http\QueryValueOutOfRangeHttpException;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\GetEggsRequest;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\StoreEggRequest;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\DeleteEggRequest;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\ExportEggRequest;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\UpdateEggRequest;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;

class EggController extends ApplicationApiController
{
    /**
     * EggController constructor.
     */
    public function __construct(private EggExporterService $eggExporterService)
    {
        parent::__construct();
    }

    /**
     * Return an array of all eggs on a given nest.
     */
    public function index(GetEggsRequest $request, Nest $nest): array
    {
        $perPage = (int) $request->query('per_page', '10');
        if ($perPage > 100) {
            throw new QueryValueOutOfRangeHttpException('per_page', 1, 100);
        }

        // @phpstan-ignore-next-line
        $eggs = QueryBuilder::for(Egg::query())
            ->where('nest_id', '=', $nest->id)
            ->allowedFilters(['id', 'name', 'author'])
            ->allowedSorts(['id', 'name', 'author']);
        if ($perPage > 0) {
            $eggs = $eggs->paginate($perPage);
        }

        return $this->fractal->collection($eggs)
            ->transformWith(EggTransformer::class)
            ->toArray();
    }

    /**
     * Returns a single egg.
     */
    public function view(GetEggRequest $request, Egg $egg): array
    {
        return $this->fractal->item($egg)
            ->transformWith(EggTransformer::class)
            ->toArray();
    }

    /**
     * Creates a new egg.
     */
    public function store(StoreEggRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $merged = array_merge($validated, [
            'uuid' => Uuid::uuid4()->toString(),
            // TODO: allow this to be set in the request, and default to config value if null or not present.
            'author' => config('DASHDACTYL.service.author'),
        ]);

        $egg = Egg::query()->create($merged);

        return $this->fractal->item($egg)
            ->transformWith(EggTransformer::class)
            ->respond(Response::HTTP_CREATED);
    }

    /**
     * Updates an egg.
     */
    public function update(UpdateEggRequest $request, Egg $egg): array
    {
        $egg->update($request->validated());

        return $this->fractal->item($egg)
            ->transformWith(EggTransformer::class)
            ->toArray();
    }

    /**
     * Deletes an egg.
     *
     * @throws \Exception
     */
    public function delete(DeleteEggRequest $request, Egg $egg): Response
    {
        $egg->delete();

        return $this->returnNoContent();
    }

    /**
     * Exports an egg.
     *
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function export(ExportEggRequest $request, int $eggId): JsonResponse
    {
        return new JsonResponse($this->eggExporterService->handle($eggId));
    }
}