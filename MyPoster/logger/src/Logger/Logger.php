<?php
declare(strict_types = 1);

namespace Logger;

use Logger\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

/**
 * Logger
 */
class Logger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var HandlerInterface[]
     */
    private array $handlers = [];

    /**
     * @var callable[]
     */
    private array $processors = [];
    private string $name;
    private \DateTimeZone $timezone;

    public function __construct(
        string $name,
        array $handlers = [],
        array $processors = [],
        ?\DateTimeZone $timezone = null
    ) {
        $this->name = $name;
        $this->timezone = $timezone ?: new \DateTimeZone(date_default_timezone_get() ?: 'UTC');

        foreach ($handlers as $handler) {
            $this->pushHandler($handler);
        }

        foreach ($processors as $processor) {
            $this->pushProcessor($processor);
        }
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = [])
    {
        $record = null;

        foreach ($this->handlers as $handler) {
            // skip iteration as long as handler is not going to handle it
            if (!$handler->isHandling(['level' => $level])) {
                continue;
            }

            // Prepare log record, apply processors
            if ($record === null) {
                $record = [
                    'message' => $message,
                    'context' => $context,
                    'level' => $level,
                    'channel' => $this->name,
                    'datetime' => null,
                    'extra' => [],
                ];

                try {
                    $record['datetime'] = new \DateTimeImmutable('now', $this->timezone);
                } catch (\Throwable $e) {
                    // Handle datetime exception
                }

                try {
                    foreach ($this->processors as $processor) {
                        $record = $processor($record);
                    }
                } catch (\Throwable $e) {
                    // Handle log exception
                }
            }

            try {
                // If handler could handle a record, stop further procession
                if ($handler->handle($record)) {
                    break;
                }
            } catch (\Throwable $e) {
                // Handle log exception
            }
        }
    }

    public function pushProcessor(callable $callback): self
    {
        array_unshift($this->processors, $callback);

        return $this;
    }

    public function pushHandler(HandlerInterface $handler): self
    {
        array_unshift($this->handlers, $handler);

        return $this;
    }
}