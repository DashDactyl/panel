<?php

namespace DASHDACTYL\Repositories\Eloquent;

use DASHDACTYL\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DASHDACTYL\Exceptions\Repository\RecordNotFoundException;
use DASHDACTYL\Contracts\Repository\LocationRepositoryInterface;

class LocationRepository extends EloquentRepository implements LocationRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return Location::class;
    }

    /**
     * Return locations with a count of nodes and servers attached to it.
     */
    public function getAllWithDetails(): Collection
    {
        return $this->getBuilder()->withCount('nodes', 'servers')->get($this->getColumns());
    }

    /**
     * Return all the available locations with the nodes as a relationship.
     */
    public function getAllWithNodes(): Collection
    {
        return $this->getBuilder()->with('nodes')->get($this->getColumns());
    }

    /**
     * Return all the nodes and their respective count of servers for a location.
     *
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithNodes(int $id): Location
    {
        try {
            return $this->getBuilder()->with('nodes.servers')->findOrFail($id, $this->getColumns());
        } catch (ModelNotFoundException) {
            throw new RecordNotFoundException();
        }
    }

    /**
     * Return a location and the count of nodes in that location.
     *
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function getWithNodeCount(int $id): Location
    {
        try {
            return $this->getBuilder()->withCount('nodes')->findOrFail($id, $this->getColumns());
        } catch (ModelNotFoundException) {
            throw new RecordNotFoundException();
        }
    }
}