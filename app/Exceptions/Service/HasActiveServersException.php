<?php

namespace DASHDACTYL\Exceptions\Service;

use Illuminate\Http\Response;
use DASHDACTYL\Exceptions\DisplayException;

class HasActiveServersException extends DisplayException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}