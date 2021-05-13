<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employer.php';
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
    public function handle(Employer $employer, int $year, float $initialDays = 0): float
    {
        $days = $initialDays;

        if ($employer->getBirthDate() && $employer->getContractStart()) {
            $employerAgeYears = $year - (int)$employer->getBirthDate()->format('Y');

            if ($employerAgeYears >= 30) {
                $workingTimeYears = $year - (int)$employer->getContractStart()->format('Y');

                if ($workingTimeYears > 0) {
                    $additionalDays = floor($workingTimeYears / 5);
                    $days += $additionalDays;
                }
            }
        }

        return $this->nextHandler
            ? $this->nextHandler->handle($employer, $year, $days)
            : $days;
    }
}