<?php
declare(strict_types = 1);

namespace Logger\Handler;

/**
 * LevelAwareTrait
 */
trait LevelAwareTrait
{
    protected string $level = '';

    public function setLevel(string $level): LevelAwareInterface
    {
        $this->level = $level;

        return $this;
    }
}