<?php

namespace DASHDACTYL\Services\Nests;

use DASHDACTYL\Contracts\Repository\NestRepositoryInterface;
use DASHDACTYL\Exceptions\Service\HasActiveServersException;
use DASHDACTYL\Contracts\Repository\ServerRepositoryInterface;

class NestDeletionService
{
    /**
     * NestDeletionService constructor.
     */
    public function __construct(
        protected ServerRepositoryInterface $serverRepository,
        protected NestRepositoryInterface $repository
    ) {
    }

    /**
     * Delete a nest from the system only if there are no servers attached to it.
     *
     * @throws \DASHDACTYL\Exceptions\Service\HasActiveServersException
     */
    public function handle(int $nest): int
    {
        $count = $this->serverRepository->findCountWhere([['nest_id', '=', $nest]]);
        if ($count > 0) {
            throw new HasActiveServersException(trans('exceptions.nest.delete_has_servers'));
        }

        return $this->repository->delete($nest);
    }
}