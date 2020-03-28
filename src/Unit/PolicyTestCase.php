<?php

namespace Beanz\Testing\Unit;

use Tests\TestCase;

abstract class PolicyTestCase extends TestCase
{
    /** @var string  */
    protected $policyClassName;

    /** @var object */
    protected $policy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->policy = app($this->policyClassName);
    }

    abstract public function it_returns_false_when_access_is_denied(): void;
    abstract public function it_returns_true_when_access_is_granted(): void;
}
