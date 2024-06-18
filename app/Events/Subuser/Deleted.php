<?php

namespace DASHDACTYL\Events\Subuser;

use DASHDACTYL\Events\Event;
use DASHDACTYL\Models\Subuser;
use Illuminate\Queue\SerializesModels;

class Deleted extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Subuser $subuser)
    {
    }
}