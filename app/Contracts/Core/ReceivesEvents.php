<?php

namespace DASHDACTYL\Contracts\Core;

use DASHDACTYL\Events\Event;

interface ReceivesEvents
{
    /**
     * Handles receiving an event from the application.
     */
    public function handle(Event $notification): void;
}