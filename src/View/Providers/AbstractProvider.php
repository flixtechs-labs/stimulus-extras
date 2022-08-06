<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

abstract class AbstractProvider
{
    protected function getFormattedValue(mixed $value)
    {
        if ($value instanceof \Stringable || (is_object($value) && is_callable([$value, '__toString']))) {
            return e($value, false);
        }

        if (!is_scalar($value)) {
            return e(json_encode($value), false);
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return e($value, false);
    }
}
