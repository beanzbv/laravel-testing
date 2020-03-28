<?php

namespace Beanz\Testing\Unit;

use Tests\TestCase;

abstract class RepositoryTestCase extends TestCase
{
    /** @var string */
    protected $repositoryInterface;

    /** @var object */
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = app($this->repositoryInterface);
    }
}
