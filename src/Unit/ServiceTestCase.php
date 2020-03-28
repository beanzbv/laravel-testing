<?php

namespace Beanz\Testing\Unit;

use Tests\TestCase;

abstract class ServiceTestCase extends TestCase
{
    /** @var object */
    protected $service;

    /** @var string */
    protected $serviceName;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = class_exists($this->serviceName) ? app($this->serviceName) : null;
    }
}
