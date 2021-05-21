<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employee.php';

/**
 * HandlerInterface
 */
interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;

    public function handle(Employee $employee, int $year, float $initialDays = 0): float;
}