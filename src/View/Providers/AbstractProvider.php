<?php

namespace FlixtechsLabs\TurboLaravelHelpers\View\Providers;

use JsonException;
use Stringable;

abstract class AbstractProvider
{
    /**
     * @throws JsonException
     */
    protected function getFormattedValue(mixed $value): string
    {
        if ($value instanceof Stringable || is_string($value)) {
            return e($value, false);
        }

        if (!is_scalar($value)) {
            return e( json_encode($value, JSON_THROW_ON_ERROR) ?: '', false);
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return e((string) $value, false);
    }
}
