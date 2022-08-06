<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

use Illuminate\Support\Str;

class ControllerProvider extends AbstractProvider
{
    /**
     * The stimulus controlelrs
     *
     * @var array<int, string>
     */
    protected array $controllers = [];

    /**
     * The stimulus values
     *
     * @var array<string, string>
     */
    protected array $values = [];

    /**
     * Add stimulus controller to element
     *
     * @param string $controller
     * @param array<string, string> $values
     *
     * @return void
     */
    public function addController(string $controller, array $values = []): void
    {
        array_push($this->controllers, $controller);

        collect($values)->each(function ($value, $key) use ($controller) {
            $this->values['data-' . $controller . '-' . Str::kebab($key) . '-value'] = $this->getFormattedValue($value);
        });
    }

    public function __toString()
    {
        return 'data-controller="' . trim(implode(' ', $this->controllers)) . '" ' . implode(' ', array_map(static function (string $attribute, string $value): string {
            return $attribute.'="'.$value.'"';
        }, array_keys($this->values), $this->values));
    }
}
