<?php
declare(strict_types = 1);

namespace Logger\Handler;

/**
 * LevelAwareInterface
 */
interface LevelAwareInterface
{
    public function setLevel(string $level): LevelAwareInterface;
}