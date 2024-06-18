<?php

namespace DASHDACTYL\Tests\Unit\Http\Middleware;

use DASHDACTYL\Tests\TestCase;
use DASHDACTYL\Tests\Traits\Http\RequestMockHelpers;
use DASHDACTYL\Tests\Traits\Http\MocksMiddlewareClosure;
use DASHDACTYL\Tests\Assertions\MiddlewareAttributeAssertionsTrait;

abstract class MiddlewareTestCase extends TestCase
{
    use MiddlewareAttributeAssertionsTrait;
    use MocksMiddlewareClosure;
    use RequestMockHelpers;

    /**
     * Setup tests with a mocked request object and normal attributes.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->buildRequestMock();
    }
}