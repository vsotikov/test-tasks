<?php
declare(strict_types = 1);

namespace Logger\Handler;

use Logger\Formatter\FormatterInterface;

/**
 * FormattableHandlerInterface
 */
interface FormattableHandlerInterface
{
    public function setFormatter(FormatterInterface $formatter): FormattableHandlerInterface;
    public function getFormatter(): ?FormatterInterface;
}