<?php
declare(strict_types = 1);

require_once 'src/Request.php';
require_once 'src/DataSource/Employers.php';
require_once 'src/VacationDaysCalculator/Calculator.php';

try {
    $request = new Request();

    $year = (int)$request->getConsoleParam(0);

    // Year is the only required input argument
    if (!$year) {
        throw new UnexpectedValueException('A valid year in format YYYY must be provided as the first argument');
    }

    $employers = new Employers();
    $vacationDaysCalculator = new Calculator();

    // Load data
    $employers->load();

    // Start output
    print str_repeat('=', 80) . "\n";

    foreach ($employers as $employer) {
        print sprintf(
            "%s: %.1f vacation days\n",
            $employer->getName(),
            $vacationDaysCalculator->calcDaysNumberForEmployer($employer, $year)
        );
    }

    print str_repeat('=', 80) . "\n";

    return 0;
} catch (Throwable $e) {
    print sprintf("An error occurred: %s (Code %d)\n", $e->getMessage(), $e->getCode());
    return -1;
}