<?php
declare(strict_types = 1);

namespace Logger\Formatter;

/**
 * FormatterInterface
 */
interface FormatterInterface
{
    /**
     * @return mixed The formatted record
     */
    public function format(array $record);
}