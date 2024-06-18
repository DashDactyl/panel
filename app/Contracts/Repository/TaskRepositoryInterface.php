<?php

namespace DASHDACTYL\Contracts\Repository;

use DASHDACTYL\Models\Task;

interface TaskRepositoryInterface extends RepositoryInterface
{
    /**
     * Get a task and the server relationship for that task.
     *
     * @throws \DASHDACTYL\Exceptions\Repository\RecordNotFoundException
     */
    public function getTaskForJobProcess(int $id): Task;

    /**
     * Returns the next task in a schedule.
     */
    public function getNextTask(int $schedule, int $index): ?Task;
}