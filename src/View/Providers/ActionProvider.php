<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

class ActionProvider extends AbstractProvider
{
    /**
     * The stimulus actions
     *
     * @var array
     */
    protected array $actions = [];

    /**
     * The stimulus params
     *
     * @var array
     */
    protected array $parameters = [];

    public function addAction(string $controller, string $action, ?string $event = null, array $params = [])
    {
        $this->actions[$controller] = is_null($event) ? e($controller, false) . '#' . e($action) : e($event) . '->' . e($controller, false) . '#' . e($action);

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
