<?php

namespace Beanz\Testing;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;

class TestBootstrap
{
    use CreatesApplication;

    /** @var Application */
    protected $app = null;

    public function bootstrap(): void
    {
        if (getenv('MYSQL_BOOTSTRAP') !== false) {
            return;
        }

        if (!$this->app) {
            $this->app = $this->createApplication();
        }

        Artisan::call('up');
        Artisan::call('migrate:fresh');

        putenv('MYSQL_BOOTSTRAP=true');
    }
}
