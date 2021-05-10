<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output;

/**
 * ResultInterface
 *
 * @package App\MyraInvoice\Invoice\Storage
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
interface OutputResultInterface
{
    public function __toString(): string;
}