<?php

declare(strict_types=1);

namespace Iamprincesly\GoogleVertexAI\Traits;

use BadMethodCallException;

trait BaseEnum
{
    /**
     * Get the names of all cases as array
     */
    public static function namesToArray(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get all the values of all cases as array
     */
    public static function valuesToArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get the associative array of the Enums cases and values
     */
    public static function toArray(): array
    {
        return array_combine(self::namesToArray(), self::valuesToArray());
    }

    /**
     * Returns enum values as a string.
     */
    public static function valuesToString(string $separator = ','): string
    {
        return implode($separator, self::valuesToArray());
    }

    /**
     * Returns enum names as a string.
     */
    public static function namesToString(string $separator = ','): string
    {
        return implode($separator, self::namesToArray());
    }

    /**
     * Cast string value to Enum class
     *
     * @param string $nameOrValue
     * @param bool $should_throw = true
     *
     * @return self|null
     *
     * @throws BadMethodCallException
     */
    public static function cast(string $nameOrValue, bool $should_throw = true): self|null
    {
        foreach (self::cases() as $case) {
            if ($nameOrValue === $case->value || $nameOrValue === $case->name) {
                return $case;
            }
        }

        if (true === $should_throw) {
            throw new BadMethodCallException("Invalid enum value or name: {$nameOrValue}");
        }

        return null;
    }
}
