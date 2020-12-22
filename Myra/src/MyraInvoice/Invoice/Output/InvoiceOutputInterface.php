<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output;

use App\MyraInvoice\Invoice\Template\ResultInvoice;

/**
 * InvoiceStorageInterface
 *
 * @package App\MyraInvoice\Invoice\Storage
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
interface InvoiceOutputInterface
{
    public function output(ResultInvoice $resultInvoice): OutputResultInterface;
}