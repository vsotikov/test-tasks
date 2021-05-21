<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employee.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerInterface.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerTrait.php';

/**
 * SpecialContractDaysHandler
 */
class SpecialContractHandler implements HandlerInterface
{
    use HandlerTrait;

    /**
     * A special contract can overwrite the amount of minimum vacation days
     */
    public function handle(Employee $employee, int $year, float $initialDays = 0): float
    {
        $days = $employee->getContractSpecialVacationDays() ?? $initialDays;

        return $this->nextHandler
            ? $this->nextHandler->handle($employee, $year, $days)
            : $days;
    }
}