<?php

namespace DASHDACTYL\Facades;

use Illuminate\Support\Facades\Facade;
use DASHDACTYL\Services\Activity\ActivityLogTargetableService;

class LogTarget extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogTargetableService::class;
    }
}