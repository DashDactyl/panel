<?php

namespace DASHDACTYL\Events\Server;

use DASHDACTYL\Events\Event;
use DASHDACTYL\Models\Server;
use Illuminate\Queue\SerializesModels;

class Deleted extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Server $server)
    {
    }
}