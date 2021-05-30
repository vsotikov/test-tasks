<?php
declare(strict_types = 1);

namespace Logger\Handler;

/**
 * HandlerInterface
 */
interface HandlerInterface
{
    public function isHandling(array $record): bool;
    public function handle(array $record): bool;
    public function close(): void;
}