<?php
declare(strict_types = 1);

/**
 * Request
 */
class Request
{
    public function getConsoleParam(int $number): ?string
    {
        return $this->getConsoleParams()[$number] ?? null;
    }

    public function getConsoleParams(): array
    {
        global $argv;

        $params = $argv;

        unset($params[0]);

        return array_values($params);
    }
}