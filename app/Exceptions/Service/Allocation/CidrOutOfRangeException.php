<?php

namespace DASHDACTYL\Exceptions\Service\Allocation;

use DASHDACTYL\Exceptions\DisplayException;

class CidrOutOfRangeException extends DisplayException
{
    /**
     * CidrOutOfRangeException constructor.
     */
    public function __construct()
    {
        parent::__construct(trans('exceptions.allocations.cidr_out_of_range'));
    }
}