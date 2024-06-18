<?php

namespace DASHDACTYL\Providers;

use Illuminate\Support\ServiceProvider;
use DASHDACTYL\Repositories\Eloquent\EggRepository;
use DASHDACTYL\Repositories\Eloquent\NestRepository;
use DASHDACTYL\Repositories\Eloquent\NodeRepository;
use DASHDACTYL\Repositories\Eloquent\TaskRepository;
use DASHDACTYL\Repositories\Eloquent\UserRepository;
use DASHDACTYL\Repositories\Eloquent\ApiKeyRepository;
use DASHDACTYL\Repositories\Eloquent\ServerRepository;
use DASHDACTYL\Repositories\Eloquent\SessionRepository;
use DASHDACTYL\Repositories\Eloquent\SubuserRepository;
use DASHDACTYL\Repositories\Eloquent\DatabaseRepository;
use DASHDACTYL\Repositories\Eloquent\LocationRepository;
use DASHDACTYL\Repositories\Eloquent\ScheduleRepository;
use DASHDACTYL\Repositories\Eloquent\SettingsRepository;
use DASHDACTYL\Repositories\Eloquent\AllocationRepository;
use DASHDACTYL\Contracts\Repository\EggRepositoryInterface;
use DASHDACTYL\Repositories\Eloquent\EggVariableRepository;
use DASHDACTYL\Contracts\Repository\NestRepositoryInterface;
use DASHDACTYL\Contracts\Repository\NodeRepositoryInterface;
use DASHDACTYL\Contracts\Repository\TaskRepositoryInterface;
use DASHDACTYL\Contracts\Repository\UserRepositoryInterface;
use DASHDACTYL\Repositories\Eloquent\DatabaseHostRepository;
use DASHDACTYL\Contracts\Repository\ApiKeyRepositoryInterface;
use DASHDACTYL\Contracts\Repository\ServerRepositoryInterface;
use DASHDACTYL\Repositories\Eloquent\ServerVariableRepository;
use DASHDACTYL\Contracts\Repository\SessionRepositoryInterface;
use DASHDACTYL\Contracts\Repository\SubuserRepositoryInterface;
use DASHDACTYL\Contracts\Repository\DatabaseRepositoryInterface;
use DASHDACTYL\Contracts\Repository\LocationRepositoryInterface;
use DASHDACTYL\Contracts\Repository\ScheduleRepositoryInterface;
use DASHDACTYL\Contracts\Repository\SettingsRepositoryInterface;
use DASHDACTYL\Contracts\Repository\AllocationRepositoryInterface;
use DASHDACTYL\Contracts\Repository\EggVariableRepositoryInterface;
use DASHDACTYL\Contracts\Repository\DatabaseHostRepositoryInterface;
use DASHDACTYL\Contracts\Repository\ServerVariableRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register all the repository bindings.
     */
    public function register(): void
    {
        // Eloquent Repositories
        $this->app->bind(AllocationRepositoryInterface::class, AllocationRepository::class);
        $this->app->bind(ApiKeyRepositoryInterface::class, ApiKeyRepository::class);
        $this->app->bind(DatabaseRepositoryInterface::class, DatabaseRepository::class);
        $this->app->bind(DatabaseHostRepositoryInterface::class, DatabaseHostRepository::class);
        $this->app->bind(EggRepositoryInterface::class, EggRepository::class);
        $this->app->bind(EggVariableRepositoryInterface::class, EggVariableRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(NestRepositoryInterface::class, NestRepository::class);
        $this->app->bind(NodeRepositoryInterface::class, NodeRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ServerRepositoryInterface::class, ServerRepository::class);
        $this->app->bind(ServerVariableRepositoryInterface::class, ServerVariableRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(SubuserRepositoryInterface::class, SubuserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}