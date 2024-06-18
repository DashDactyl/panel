<?php

namespace DASHDACTYL\Http\Controllers\Api\Application\Eggs;

use DASHDACTYL\Models\Egg;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DASHDACTYL\Models\EggVariable;
use Illuminate\Database\ConnectionInterface;
use DASHDACTYL\Services\Eggs\Variables\VariableUpdateService;
use DASHDACTYL\Services\Eggs\Variables\VariableCreationService;
use DASHDACTYL\Transformers\Api\Application\EggVariableTransformer;
use DASHDACTYL\Http\Controllers\Api\Application\ApplicationApiController;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\Variables\StoreEggVariableRequest;
use DASHDACTYL\Http\Requests\Api\Application\Eggs\Variables\UpdateEggVariablesRequest;

class EggVariableController extends ApplicationApiController
{
    public function __construct(
        private ConnectionInterface $connection,
        private VariableCreationService $variableCreationService,
        private VariableUpdateService $variableUpdateService
    ) {
        parent::__construct();
    }

    /**
     * Creates a new egg variable.
     *
     * @throws \DASHDACTYL\Exceptions\Model\DataValidationException
     * @throws \DASHDACTYL\Exceptions\Service\Egg\Variable\BadValidationRuleException
     * @throws \DASHDACTYL\Exceptions\Service\Egg\Variable\ReservedVariableNameException
     */
    public function store(StoreEggVariableRequest $request, Egg $egg): array
    {
        $variable = $this->variableCreationService->handle($egg->id, $request->validated());

        return $this->fractal->item($variable)
            ->transformWith(EggVariableTransformer::class)
            ->toArray();
    }

    /**
     * Updates multiple egg variables.
     *
     * @throws \Throwable
     */
    public function update(UpdateEggVariablesRequest $request, Egg $egg): array
    {
        $validated = $request->validated();

        $this->connection->transaction(function () use ($egg, $validated) {
            foreach ($validated as $data) {
                $this->variableUpdateService->handle($egg, $data);
            }
        });

        return $this->fractal->collection($egg->refresh()->variables)
            ->transformWith(EggVariableTransformer::class)
            ->toArray();
    }

    /**
     * Deletes a single egg variable.
     */
    public function delete(Request $request, Egg $egg, EggVariable $eggVariable): Response
    {
        EggVariable::query()
            ->where('id', $eggVariable->id)
            ->where('egg_id', $egg->id)
            ->delete();

        return $this->returnNoContent();
    }
}