<?php

namespace DASHDACTYL\Repositories\Eloquent;

use DASHDACTYL\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DASHDACTYL\Contracts\Repository\TaskRepositoryInterface;
use DASHDACTYL\Exceptions\Repository\RecordNotFoundException;

class TaskRepository extends EloquentRepository implements TaskRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return Task::class;
    }

    /**
     * Get a task and the server relationship for that task.
     *
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function getTaskForJobProcess(int $id): Task
    {
        try {
            return $this->getBuilder()->with('server.user', 'schedule')->findOrFail($id, $this->getColumns());
        } catch (ModelNotFoundException) {
            throw new RecordNotFoundException();
        }
    }

    /**
     * Returns the next task in a schedule.
     */
    public function getNextTask(int $schedule, int $index): ?Task
    {
        return $this->getBuilder()->where('schedule_id', '=', $schedule)
            ->orderBy('sequence_id')
            ->where('sequence_id', '>', $index)
            ->first($this->getColumns());
    }
}