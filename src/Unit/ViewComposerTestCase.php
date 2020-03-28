<?php

namespace Beanz\Testing\Unit;

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Mockery;
use Tests\TestCase;

abstract class ViewComposerTestCase extends TestCase
{
    /** @var View */
    protected $view;

    /** @var string */
    protected $viewName;

    /** @var Route */
    protected $routeMock;

    /** @var string */
    protected $route = 'test/checkViewComposer';

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestEnvironment();
    }

    protected function setUpTestEnvironment(): void
    {
        view()->addNamespace('test_view', base_path('tests/resources/views'));

        $routes = Route::getRoutes();

        $this->routeMock = Mockery::mock(RoutingRoute::class)->makePartial();
        $this->routeMock->shouldReceive('parameters')->andReturn($this->getParameters());

        Route::shouldReceive('current')->andReturn($this->routeMock);
        Route::shouldReceive('getRoutes')->andReturn($routes);
        Route::makePartial();

        Auth::shouldReceive('user')->andReturn($this->user);

        $this->view = View::make('test_view::view-composer');
    }

    protected function setUpTestRoute(): void
    {
        Route::get(
            $this->route,
            function () {
                return response()->view(
                    $this->viewName,
                    [
                        'redirectRoute' => 'web.home',
                    ]
                );
            }
        );

        $this->actingAs($this->user);
    }
}
