<?php

namespace Beanz\Testing\Unit;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as ResponseStatus;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

abstract class MiddlewareTestCase extends ControllerTestCase
{
    /** URL that needs to be called to test the middleware. */
    protected const TEST_URL = 'test/checkMiddleware';

    /** The name of the url that needs to be called. */
    protected const TEST_URL_NAME = 'test.checkMiddleware';

    /** @var Closure */
    protected $requestResponder;

    /** @var Request */
    protected $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = null;

        // Dummy function to respond to test-requests.
        $this->setUpRequestResponder();

        // Route which requires a Right.
        Route::get(static::TEST_URL, ['uses' => $this->requestResponder, 'as' => static::TEST_URL_NAME])
            ->middleware(['bindings', $this->getRouteMiddleware()]);
    }

    /** @return string */
    abstract protected function getRouteMiddleware(): string;

    protected function setUpRequestResponder(): void
    {
        $this->requestResponder = function (Request $request) {
            $this->request = $request;

            return Response::json([], ResponseStatus::HTTP_OK);
        };
    }

    protected function getTestUrl(): string
    {
        return route(self::TEST_URL_NAME, $this->getUrlParameters());
    }

    protected function getRequestObject(): Request
    {
        return $this->request;
    }

    protected function getUrlParameters(): array
    {
        return [];
    }
}
