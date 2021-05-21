<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employee.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerInterface.php';
require_once 'src/VacationDaysCalculator/Handlers/HandlerTrait.php';

/**
 * PartialYearHandler
 */
class PartialYearHandler implements HandlerInterface
{
    use HandlerTrait;

    /**
     * Contracts starting in the course of the year get 1/12 of the yearly vacation days for each fullmonth
     */
    public function handle(Employee $employee, int $year, float $initialDays = 0): float
    {
        $days = $initialDays;

        if ($employee->getContractStart() &&
            (int)$employee->getContractStart()->format('Y') === $year
        ) {
            // If an Employee starts on the 1st of the month, consider this month
            // In other case start month is the following month
            $startMonth = (int)$employee->getContractStart()->format('d') === 1
                ? (int)$employee->getContractStart()->format('m')
                : (int)$employee->getContractStart()->format('m') + 1;

            // Calc total full working months
            $fullMonths = 12 - $startMonth + 1;

            // Divide input annually vacation days by full months
            $days = $fullMonths > 0
                ? round($days / 12 * $fullMonths, 1)
                : 0;

            $fraction = (int)round(($days - floor($days)) * 100, 0);

            if ($fraction !== 50) {
                $days = round($days);
            }
        }

        return $this->nextHandler
            ? $this->nextHandler->handle($employee, $days)
            : $days;
    }
}