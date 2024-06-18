<?php

namespace DASHDACTYL\Tests\Integration;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use DASHDACTYL\Tests\TestCase;
use Illuminate\Support\Facades\Event;
use DASHDACTYL\Events\ActivityLogged;
use DASHDACTYL\Tests\Assertions\AssertsActivityLogged;
use DASHDACTYL\Tests\Traits\Integration\CreatesTestModels;

abstract class IntegrationTestCase extends TestCase
{
    use CreatesTestModels;
    use AssertsActivityLogged;

    protected $defaultHeaders = [
        'Accept' => 'application/json',
    ];

    public function setUp(): void
    {
        parent::setUp();

        Event::fake(ActivityLogged::class);
    }

    /**
     * Return an ISO-8601 formatted timestamp to use in the API response.
     */
    protected function formatTimestamp(string $timestamp): string
    {
        return CarbonImmutable::createFromFormat(CarbonInterface::DEFAULT_TO_STRING_FORMAT, $timestamp)
            ->setTimezone('UTC')
            ->toAtomString();
    }
}