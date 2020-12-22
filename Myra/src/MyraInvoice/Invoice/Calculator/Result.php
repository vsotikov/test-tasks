<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Calculator;

use App\MyraInvoice\Customer\Customer;
use App\MyraInvoice\Invoice\DataSource\InvoiceDataSourceInterface;

/**
 * Result
 *
 * @package App\MyraInvoice\Invoice\Calculator
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Result
{
    private Customer $customer;
    private InvoiceDataSourceInterface $invoiceDataSource;
    private array $period;

    private string $invoiceNumber = '';
    private \DateTimeInterface $invoiceDatetime;
    private array $invoiceMonths = [];
    private float $invoiceQuantity = 0;
    private float $invoiceNetEur = 0;
    private float $invoiceGrossEur = 0;

    public function __construct()
    {
        $this->invoiceNumber = (string)random_int(1000000000, 9000000000);
        $this->invoiceDatetime = new \DateTimeImmutable();
    }

    public function getInvoiceDataSource(): ?InvoiceDataSourceInterface
    {
        return $this->invoiceDataSource;
    }

    public function setInvoiceDataSource(?InvoiceDataSourceInterface $invoiceDataSource): self
    {
        $this->invoiceDataSource = $invoiceDataSource;

        return $this;
    }

    /**
     * @return \DateTimeInterface[]|null
     */
    public function getPeriod(): ?array
    {
        return $this->period;
    }

    public function setPeriod(?array $period): self
    {
        if (!empty($period)) {
            foreach ($period as $datetime) {
                if (!($datetime instanceof \DateTimeInterface)) {
                    throw new \InvalidArgumentException('$period should be an array of DateTimeInterface objects');
                }
            }
        }

        $this->period = $period;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function getInvoiceDatetime(): \DateTimeInterface
    {
        return $this->invoiceDatetime;
    }

    public function getMonths(): array
    {
        return $this->invoiceMonths;
    }

    public function shouldBePayed(): bool
    {
        return true;
    }

    public function getQuantity(): float
    {
        return $this->invoiceQuantity;
    }

    public function getNetEur(): float
    {
        return $this->invoiceNetEur;
    }

    public function getGrossEur(): float
    {
        return $this->invoiceGrossEur;
    }

    public function setMonths(array $values): self
    {
        $this->invoiceMonths = $values;

        return $this;
    }

    public function setQuantity(float $value): self
    {
        $this->invoiceQuantity = $value;

        return $this;
    }

    public function setNetEur(float $value): self
    {
        $this->invoiceNetEur = $value;

        return $this;
    }

    public function setGrossEur(float $value): self
    {
        $this->invoiceGrossEur = $value;

        return $this;
    }
}