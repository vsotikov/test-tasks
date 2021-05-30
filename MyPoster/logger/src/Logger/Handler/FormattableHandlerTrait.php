<?php
declare(strict_types = 1);

namespace Logger\Handler;

use Logger\Formatter\FormatterInterface;

/**
 * FormattableHandlerTrait
 */
trait FormattableHandlerTrait
{
    protected ?FormatterInterface $formatter = null;

    /**
     * {@inheritdoc}
     */
    public function setFormatter(FormatterInterface $formatter): FormattableHandlerInterface
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormatter(): ?FormatterInterface
    {
        return $this->formatter;
    }
}