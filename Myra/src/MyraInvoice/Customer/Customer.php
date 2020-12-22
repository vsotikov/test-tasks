<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Customer;

/**
 * Customer
 *
 * @package App\MyraInvoice\Customer
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Customer
{
    public const PLACEHOLDER_DOMAIN = '%DOMAIN%';
    public const PLACEHOLDER_NAME = '%SHORTCUSTOMER%';
    public const PLACEHOLDER_ADDRESS_1 = '%ANSCHRIFT-ZEILE1%';
    public const PLACEHOLDER_ADDRESS_2 = '%ANSCHRIFT-ZEILE2%';
    public const PLACEHOLDER_ADDRESS_3 = '%ANSCHRIFT-ZEILE3%';
    public const PLACEHOLDER_ADDRESS_4 = '%ANSCHRIFT-ZEILE4%';
    public const PLACEHOLDER_VAT = '%MWST%';
    public const PLACEHOLDER_PACKAGE_PRICE_EUR = '%EINHEITSPREIS%';

    private string $domain;
    private string $name;
    private string $addressLine1;
    private string $addressLine2;
    private string $addressLine3;
    private string $addressLine4;
    private int $vat;
    private float $packagePrice;

    public function __construct(array $data)
    {
        $this->domain = $data[self::PLACEHOLDER_DOMAIN] ?? '';
        $this->name = $data[self::PLACEHOLDER_NAME] ?? '';
        $this->addressLine1 = $data[self::PLACEHOLDER_ADDRESS_1] ?? '';
        $this->addressLine2 = $data[self::PLACEHOLDER_ADDRESS_2] ?? '';
        $this->addressLine3 = $data[self::PLACEHOLDER_ADDRESS_3] ?? '';
        $this->addressLine4 = $data[self::PLACEHOLDER_ADDRESS_4] ?? '';
        $this->vat = (int)(max(0, $data[self::PLACEHOLDER_VAT] ?? 0));
        $this->packagePrice = (float)(max(0, $data[self::PLACEHOLDER_PACKAGE_PRICE_EUR] ?? 0));
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->addressLine2;
    }

    /**
     * @return string
     */
    public function getAddressLine3(): string
    {
        return $this->addressLine3;
    }

    /**
     * @return string
     */
    public function getAddressLine4(): string
    {
        return $this->addressLine4;
    }

    /**
     * @return int
     */
    public function getVat(): int
    {
        return $this->vat;
    }

    /**
     * @return float
     */
    public function getPackagePrice(): float
    {
        return $this->packagePrice;
    }
}