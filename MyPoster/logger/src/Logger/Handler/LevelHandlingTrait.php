<?php
declare(strict_types = 1);

namespace Logger\Handler;

use Logger\LogLevel;

/**
 * LevelHandlingTrait
 */
trait LevelHandlingTrait
{
    protected function isHandling(array $record): bool
    {
        $isHandling = true;

        if ($this instanceof LevelAwareInterface && !empty($this->level)) {
            $isHandling = false;

            try {
                $recordLevel = LogLevel::psrToLevel($record['level'] ?? '');
                $handlerLevel = LogLevel::psrToLevel($this->level);

                $isHandling = $recordLevel >= $handlerLevel;
            } catch (\UnexpectedValueException $e) {}
        }

        return $isHandling;
    }
}