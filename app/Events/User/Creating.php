<?php

namespace DASHDACTYL\Events\User;

use DASHDACTYL\Models\User;
use DASHDACTYL\Events\Event;
use Illuminate\Queue\SerializesModels;

class Creating extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user)
    {
    }
}