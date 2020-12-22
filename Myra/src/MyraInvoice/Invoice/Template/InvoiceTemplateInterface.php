<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Template;

use App\MyraInvoice\Invoice\Calculator\Result as CalculatorResult;

/**
 * InvoiceTemplateInterface
 *
 * @package App\MyraInvoice\Invoice\Template
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
interface InvoiceTemplateInterface
{
    public function applyInvoice(CalculatorResult $result): ResultInvoice;
}