<?php

namespace DASHDACTYL\Facades;

use Illuminate\Support\Facades\Facade;
use DASHDACTYL\Services\Activity\ActivityLogService;

class Activity extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogService::class;
    }
}