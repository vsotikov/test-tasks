<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employer.php';

/**
 * HandlerInterface
 */
interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;

    public function handle(Employer $employer, int $year, float $initialDays = 0): float;
}