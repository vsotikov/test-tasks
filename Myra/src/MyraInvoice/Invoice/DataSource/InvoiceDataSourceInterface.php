<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\DataSource;

use App\MyraInvoice\Customer\Customer;

/**
 * InvoiceDataSourceInterface
 *
 * @package App\MyraInvoice\Invoice\DataSource
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
interface InvoiceDataSourceInterface
{
    /**
     * @param Customer $customer
     * @param \DateTimeInterface[] $period
     * @return array(
     *   array(
     *     'pi' => int,
     *     'datetime' => \DateTimeInterface
     *   ),
     *  ...
     * );
     */
    public function getForCustomerAndPeriod(Customer $customer, array $period): array;
}