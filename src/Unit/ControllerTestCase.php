<?php

namespace Beanz\Testing\Unit;

use Tests\TestCase;
use Illuminate\Testing\TestResponse;

abstract class ControllerTestCase extends TestCase
{
    /** @var string */
    protected $routeName;

    /** @var string */
    protected $redirectRouteName;

    /** @var string */
    protected $method;

    /** @var array */
    private $urlParameters = [];

    /** @var array */
    private $redirectParameters = [];

    protected function setUp(): void
    {
        parent::setUp();

        if (property_exists(self::class, 'user') && is_object($this->user)) {
            $this->actingAs($this->user);
        }
    }

    protected function execute(
        array $data = null,
        string $uri = null,
        string $method = null,
        array $headers = []
    ): TestResponse {
        $method = $method ?? $this->method;
        $data = $data ?? $this->getData();
        $uri = $uri ?? route($this->routeName, $this->urlParameters ?? []);

        return $this->json($method, $uri, $data, $headers);
    }

    protected function getUrlParameters(): array
    {
        return $this->urlParameters;
    }

    protected function setUrlParameters(array $urlParameters = []): self
    {
        $this->urlParameters = $urlParameters;

        return $this;
    }

    protected function getRedirectParameters(): array
    {
        return $this->redirectParameters;
    }

    protected function setRedirectParameters(array $urlParameters = []): self
    {
        $this->redirectParameters = $urlParameters;

        return $this;
    }

    protected function getRedirectUrl(): string
    {
        return route($this->redirectRouteName, $this->getRedirectParameters());
    }

    protected function getData(): array
    {
        return [];
    }
}
