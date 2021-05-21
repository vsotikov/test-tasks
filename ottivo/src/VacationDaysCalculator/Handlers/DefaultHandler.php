<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employee.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerInterface.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerTrait.php';

/**
 * DefaultVacationDaysHandler
 */
class DefaultHandler implements HandlerInterface
{
    use HandlerTrait;

    private const DAYS_NUMBER = 26;

    /**
     * Each employee has a minimum of 26 vacation days regardless of age
     */
    public function handle(Employee $employee, int $year, float $initialDays = 0): float
    {
        return $this->nextHandler
            ? $this->nextHandler->handle($employee, $year, self::DAYS_NUMBER)
            : self::DAYS_NUMBER;
    }
}