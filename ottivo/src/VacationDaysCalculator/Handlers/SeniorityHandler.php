<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employee.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerInterface.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerTrait.php';

/**
 * SeniorityHandler
 */
class SeniorityHandler implements HandlerInterface
{
    use HandlerTrait;

    /**
     * Employees >= 30 years get one additional vacation day every 5 years
     */
    public function handle(Employee $employee, int $year, float $initialDays = 0): float
    {
        $days = $initialDays;

        if ($employee->getBirthDate() && $employee->getContractStart()) {
            $employeeAgeYears = $year - (int)$employee->getBirthDate()->format('Y');

            if ($employeeAgeYears >= 30) {
                $workingTimeYears = $year - (int)$employee->getContractStart()->format('Y');

                if ($workingTimeYears > 0) {
                    $additionalDays = floor($workingTimeYears / 5);
                    $days += $additionalDays;
                }
            }
        }

        return $this->nextHandler
            ? $this->nextHandler->handle($employee, $year, $days)
            : $days;
    }
}