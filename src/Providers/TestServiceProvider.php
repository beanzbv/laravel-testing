<?php

namespace Beanz\Testing\Providers;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../bootstrap/autoload.php' => base_path('bootstrap/autoload.php'),
            __DIR__ . '/../bootstrap/phpunit-autoload.php' => base_path('bootstrap/phpunit-autoload.php'),
        ], 'bootstrap');

        $this->publishes([
            __DIR__ . '/../example.phpunit.xml' => base_path('phpunit.xml'),
        ], 'phpunit');

        $this->publishes([
            __DIR__ . '/../grump-config/.php_cs' => base_path('grump-config/.php_cs'),
            __DIR__ . '/../grump-config/grumphp.yml' => base_path('grump-config/grumphp.yml'),
            __DIR__ . '/../grump-config/phpcs.xml' => base_path('grump-config/phpcs.xml'),
            __DIR__ . '/../grump-config/ruleset.xml' => base_path('grump-config/ruleset.xml'),
        ], 'grumphp');

        $this->publishes([
            __DIR__ . '/../circleci/.circleci.env' => base_path('.circleci/.circleci.env'),
            __DIR__ . '/../circleci/config.yml' => base_path('.circleci/config.yml'),
        ], 'circleci');
    }
}
