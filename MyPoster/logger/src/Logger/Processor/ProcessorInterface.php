<?php
declare(strict_types = 1);

namespace Logger\Processor;

/**
 * ProcessorInterface
 */
interface ProcessorInterface
{
    public function __invoke(array $record);
}