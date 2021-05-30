<?php
declare(strict_types = 1);

namespace Logger\Formatter;

/**
 * LineFormatter
 */
class LineFormatter implements FormatterInterface
{
    public const FORMAT = "%datetime% %channel% %level%: %message% %context% %extra%\n";

    public function format(array $record)
    {
        // Here goes the logic of normalizing different object types such
        // datetimes, exceptions, serializable, etc.
    }
}