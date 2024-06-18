<?php

namespace DASHDACTYL\Exceptions\Service\Database;

use DASHDACTYL\Exceptions\DASHDACTYLException;

class DatabaseClientFeatureNotEnabledException extends DASHDACTYLException
{
    public function __construct()
    {
        parent::__construct('Client database creation is not enabled in this Panel.');
    }
}