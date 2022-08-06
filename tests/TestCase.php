<?php

declare(strict_types=1);

namespace FlixtechsLabs\TurboLaravelHelpers\Tests;

use FlixtechsLabs\TurboLaravelHelpers\Providers\TurboHelpersServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            TurboHelpersServiceProvider::class,
        ];
    }
}
