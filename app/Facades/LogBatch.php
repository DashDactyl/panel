<?php

namespace DASHDACTYL\Facades;

use Illuminate\Support\Facades\Facade;
use DASHDACTYL\Services\Activity\ActivityLogBatchService;

class LogBatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogBatchService::class;
    }
}