<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Template\Format;

use App\MyraInvoice\Invoice\Calculator\Result as CalculatorResult;
use App\MyraInvoice\Invoice\Template\InvoiceTemplateInterface;
use App\MyraInvoice\Invoice\Template\ResultInvoice;
use App\MyraInvoice\Invoice\Template\TemplateFormat;

/**
 * Pdf
 *
 * @package App\MyraInvoice\Invoice\Template\Format
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class Pdf implements InvoiceTemplateInterface
{
    public function applyInvoice(CalculatorResult $calculatorResult): ResultInvoice
    {
        return new ResultInvoice($calculatorResult, TemplateFormat::PDF);
    }
}