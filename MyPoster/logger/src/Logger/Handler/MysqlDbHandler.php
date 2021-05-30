<?php
declare(strict_types = 1);

namespace Logger\Handler;

/**
 * MysqlDbHandler
 */
class MysqlDbHandler implements HandlerInterface, LevelAwareInterface
{
    use LevelAwareTrait;
    use LevelHandlingTrait {
        isHandling as isHandlingByLevel;
    }

    public function isHandling(array $record): bool
    {
        return $this->isHandlingByLevel($record);
    }

    public function handle(array $record): bool
    {
        // TODO: Implement handle() method.
        return true;
    }

    public function close(): void
    {
        // TODO: Implement close() method.
    }
}