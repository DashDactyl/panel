<?php

namespace DASHDACTYL\Events\Auth;

use DASHDACTYL\Models\User;
use DASHDACTYL\Events\Event;

class DirectLogin extends Event
{
    public function __construct(public User $user, public bool $remember)
    {
    }
}