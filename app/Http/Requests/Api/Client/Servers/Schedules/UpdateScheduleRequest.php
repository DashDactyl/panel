<?php

namespace DASHDACTYL\Http\Requests\Api\Client\Servers\Schedules;

use DASHDACTYL\Models\Permission;

class UpdateScheduleRequest extends StoreScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_UPDATE;
    }
}