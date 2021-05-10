<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Customer\DataSource;

/**
 * DataSourceInterface
 *
 * @package App\MyraInvoice\Customer\DataSource
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
interface DataSourceInterface
{
    public function getCustomers(): array;
}