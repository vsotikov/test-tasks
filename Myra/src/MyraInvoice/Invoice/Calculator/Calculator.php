<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Calculator;

use App\MyraInvoice\Customer\Customer;
use App\MyraInvoice\Invoice\Calculator\Result;
use App\MyraInvoice\Invoice\DataSource\InvoiceDataSourceInterface;

/**
 * Calculator
 *
 * @package App\MyraInvoice\Invoice
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Calculator
{
    public const PI_PER_PACKAGE = 100000;

    public function calculate(Customer $customer, InvoiceDataSourceInterface $invoiceDataSource, array $period): Result
    {
        $result = (new Result())
            ->setCustomer($customer)
            ->setInvoiceDataSource($invoiceDataSource)
            ->setPeriod($period);

        $from = $period['from'] ?? null;
        $to = $period['to'] ?? null;

        if (!($from instanceof \DateTimeInterface)) {
            throw new \InvalidArgumentException('Period is invalid: "from" is not set');
        }

        if (!($to instanceof \DateTimeInterface)) {
            throw new \InvalidArgumentException('Period is invalid: "to" is not set');
        }

        $data = $invoiceDataSource->getForCustomerAndPeriod($customer, $period);
        $totalPi = 0;
        $months = [];

        foreach ($data as $row) {
            $month = $row['datetime']->format('F');
            $totalPi += $row['pi'];
            $months[$month] = $month;
        }

        $quantity = $totalPi / self::PI_PER_PACKAGE;
        $netEur = $quantity * $customer->getPackagePrice();
        $grossEur = $netEur * (100 + $customer->getVat()) / 100;

        $result
            ->setMonths(array_values($months))
            ->setQuantity($quantity)
            ->setNetEur($netEur)
            ->setGrossEur($grossEur);

        return $result;
    }
}