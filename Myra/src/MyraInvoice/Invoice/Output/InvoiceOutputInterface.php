<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output;

use App\MyraInvoice\Invoice\Template\ResultInvoice;

/**
 * InvoiceStorageInterface
 *
 * @package App\MyraInvoice\Invoice\Storage
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
interface InvoiceOutputInterface
{
    public function output(ResultInvoice $resultInvoice): OutputResultInterface;
}