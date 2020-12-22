<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Customer\DataSource;

/**
 * DataSourceInterface
 *
 * @package App\MyraInvoice\Customer\DataSource
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
interface DataSourceInterface
{
    public function getCustomers(): array;
}