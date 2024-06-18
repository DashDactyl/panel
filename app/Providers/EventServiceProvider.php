<?php

namespace DASHDACTYL\Providers;

use DASHDACTYL\Models\User;
use DASHDACTYL\Models\Server;
use DASHDACTYL\Models\Subuser;
use DASHDACTYL\Models\EggVariable;
use DASHDACTYL\Observers\UserObserver;
use DASHDACTYL\Observers\ServerObserver;
use DASHDACTYL\Observers\SubuserObserver;
use DASHDACTYL\Observers\EggVariableObserver;
use DASHDACTYL\Listeners\Auth\AuthenticationListener;
use DASHDACTYL\Events\Server\Installed as ServerInstalledEvent;
use DASHDACTYL\Notifications\ServerInstalled as ServerInstalledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        ServerInstalledEvent::class => [ServerInstalledNotification::class],
    ];

    protected $subscribe = [
        AuthenticationListener::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        User::observe(UserObserver::class);
        Server::observe(ServerObserver::class);
        Subuser::observe(SubuserObserver::class);
        EggVariable::observe(EggVariableObserver::class);
    }
}