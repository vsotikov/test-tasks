<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Customer;

use App\MyraInvoice\Customer\DataSource\DataSourceInterface;

/**
 * Customers
 *
 * @package App\MyraInvoice\Customer
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class CustomersProvider
{
    private DataSourceInterface $dataSource;

    public function __construct(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return Customer[]
     */
    public function getAll(): array
    {
        return $this->dataSource->getCustomers();
    }
}