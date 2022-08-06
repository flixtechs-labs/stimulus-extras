<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

use Illuminate\Support\Str;

class TargetProvider extends AbstractProvider
{
    /**
     * The stimulus targets
     *
     * @var array<string, string>
     */
    protected array $targets = [];

    /**
     * Add a stimulus target to an element
     *
     * @param string $controller
     * @param string $target
     *
     * @return void
     */
    public function addTarget(string $controller, string $target): void
    {
        $this->targets['data-' . Str::kebab($controller) . '-target'] = $target;
    }

    public function __toString()
    {
        return trim(implode(' ', array_map(static function (string $attribute, string $value): string {
            return $attribute . '="' . $value . '"';
        }, array_keys($this->targets), $this->targets)));
    }
}
