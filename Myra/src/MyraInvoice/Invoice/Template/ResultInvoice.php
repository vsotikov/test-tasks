<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Template;

use App\MyraInvoice\Invoice\Calculator\Result as CalculatorResult;

/**
 * ResultInvoice
 *
 * @package App\MyraInvoice\Invoice\Template
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class ResultInvoice
{
    public const CONTENT_TYPE_PLAIN_TEXT = 'text/plain';
    public const CONTENT_TYPE_TEXT_XML = 'text/xml';
    public const CONTENT_TYPE_ZIP = 'application/zip';

    private CalculatorResult $calculatorResult;
    private string $format;

    private $content;
    private string $contentType = self::CONTENT_TYPE_PLAIN_TEXT;

    public function __construct(CalculatorResult $calculatorResult, string $format)
    {
        $this->calculatorResult = $calculatorResult;
        $this->format = $format;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getCalculatorResult(): CalculatorResult
    {
        return $this->calculatorResult;
    }

    public function setContent($content, string $contentType): self
    {
        $this->content = $content;
        $this->contentType = $contentType;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }
}