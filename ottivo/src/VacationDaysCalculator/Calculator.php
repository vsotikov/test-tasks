<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employer.php';
require_once 'src/VacationDaysCalculator/Handlers/DefaultHandler.php';
require_once 'src/VacationDaysCalculator/Handlers/SpecialContractHandler.php';
require_once 'src/VacationDaysCalculator/Handlers/SeniorityHandler.php';
require_once 'src/VacationDaysCalculator/Handlers/PartialYearHandler.php';

/**
 * Calculator
 */
class Calculator
{
    private HandlerInterface $handler;

    public function __construct()
    {
        // Register initial handlers
        $this->handler = new DefaultHandler();
        $this->handler
            ->setNext(new SpecialContractHandler())
            ->setNext(new SeniorityHandler())
            ->setNext(new PartialYearHandler())
        ;
    }

    public function calcDaysNumberForEmployer(Employer $employer, int $year): float
    {
        return $this->handler->handle($employer, $year);
    }
}