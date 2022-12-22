<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

class ActionProvider extends AbstractProvider
{
    /**
     * The stimulus actions
     *
     * @var array<string>
     */
    protected array $actions = [];

    /**
     * The stimulus params
     *
     * @var array<string, string>
     */
    protected array $parameters = [];

    /**
     * Add the stimulus action
     *
     * @param string $controller
     * @param string $action
     * @param string|null $event
     * @param array<string, string> $params
     * @return void
     */
    public function addAction(string $controller, string $action, ?string $event = null, array $params = []): void
    {
        $this->actions[] = is_null($event) ? e($controller, false) . '#' . e($action) : e($event) . '->' . e($controller, false) . '#' . e($action);

        foreach ($params as $name => $value) {
            $this->parameters['data-' . e($controller, false) . '-' . e($name) . '-param'] = $this->getFormattedValue($value);
        }
    }

    public function __toString()
    {
        return rtrim('data-action="'.implode(' ', $this->actions).'" '.implode(' ', array_map(static function (string $attribute, string $value): string {
            return $attribute.'="'.$value.'"';
        }, array_keys($this->parameters), $this->parameters)));
    }
}
