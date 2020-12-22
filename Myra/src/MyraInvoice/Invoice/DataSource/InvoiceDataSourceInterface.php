<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\DataSource;

use App\MyraInvoice\Customer\Customer;

/**
 * InvoiceDataSourceInterface
 *
 * @package App\MyraInvoice\Invoice\DataSource
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
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