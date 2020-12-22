<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Template\Format;

use App\MyraInvoice\Customer\Customer;
use App\MyraInvoice\Invoice\Calculator\Result as CalculatorResult;
use App\MyraInvoice\Invoice\Template\InvoiceTemplateInterface;
use App\MyraInvoice\Invoice\Template\ResultInvoice;
use App\MyraInvoice\Invoice\Template\TemplateFormat;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Odt
 *
 * @package App\MyraInvoice\Invoice\Template\Format
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Odt implements InvoiceTemplateInterface
{
    public const PLACEHOLDER_REDATUM = '%REDATUM%';
    public const PLACEHOLDER_RENR = '%RENR%';
    public const PLACEHOLDER_MONAT = '%MONAT%';
    public const PLACEHOLDER_ANZAHL = '%ANZAHL%';
    public const PLACEHOLDER_NETTOMYRA = '%NETTOMYRA%';
    public const PLACEHOLDER_GESAMTSUMME = '%GESAMTSUMME%';

    private string $templateFilename = '/data/Template_Rechnung_Deutschland.odt';

    public function __construct(KernelInterface $kernel)
    {
        $this->templateFilename = $kernel->getProjectDir() . $this->templateFilename;
    }

    public function applyInvoice(CalculatorResult $calculatorResult): ResultInvoice
    {
        $resultInvoice = new ResultInvoice($calculatorResult, TemplateFormat::ODT);

        // Create a template copy
        $filename = tempnam(sys_get_temp_dir(), $calculatorResult->getInvoiceNumber());

        if (!copy($this->templateFilename, $filename)) {
            throw new IOException(sprintf(
                'Could not copy template file %s to %s',
                $this->templateFilename,
                $filename
            ));
        }

        $zip = new \ZipArchive();

        if ($zip->open($filename) === true) {
            if (($index = $zip->locateName('content.xml')) !== false) {
                $document = new \DOMDocument();
                $document->loadXML(
                    $zip->getFromIndex($index),
                    LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING
                );

                // Fetch replaces
                $replaces = $this->getReplaces($calculatorResult);

                // Replace content in archive
                $zip->deleteName('content.xml');
                $zip->addFromString(
                    'content.xml',
                    str_replace(
                        array_keys($replaces),
                        array_values($replaces),
                        $document->saveXML()
                    )
                );

                $resultInvoice->setContent(
                    $filename,
                    ResultInvoice::CONTENT_TYPE_ZIP
                );
            }

            $zip->close();
        }

        return $resultInvoice;
    }

    private function getReplaces(CalculatorResult $calculatorResult): array
    {
        $replaces = [];

        // Customer related placeholders
        $customer = $calculatorResult->getCustomer();

        $replaces[Customer::PLACEHOLDER_NAME] = $customer->getName();
        $replaces[Customer::PLACEHOLDER_DOMAIN] = $customer->getDomain();
        $replaces[Customer::PLACEHOLDER_ADDRESS_1] = $customer->getAddressLine1();
        $replaces[Customer::PLACEHOLDER_ADDRESS_2] = $customer->getAddressLine2();
        $replaces[Customer::PLACEHOLDER_ADDRESS_3] = $customer->getAddressLine3();
        $replaces[Customer::PLACEHOLDER_ADDRESS_4] = $customer->getAddressLine4();
        $replaces[Customer::PLACEHOLDER_VAT] = $customer->getVat() . '%';
        $replaces[Customer::PLACEHOLDER_PACKAGE_PRICE_EUR] = sprintf('%.2f EUR', $customer->getPackagePrice());

        // Calculated result related placeholders
        $replaces[self::PLACEHOLDER_REDATUM] = $calculatorResult->getInvoiceDatetime()->format('d.m.Y');
        $replaces[self::PLACEHOLDER_RENR] = $calculatorResult->getInvoiceNumber();
        $replaces[self::PLACEHOLDER_MONAT] = implode(', ', $calculatorResult->getMonths());
        $replaces[self::PLACEHOLDER_ANZAHL] = sprintf('%.2f', $calculatorResult->getQuantity());
        $replaces[self::PLACEHOLDER_NETTOMYRA] = sprintf('%.2f EUR', $calculatorResult->getNetEur());
        $replaces[self::PLACEHOLDER_GESAMTSUMME] = sprintf('%.2f EUR', $calculatorResult->getGrossEur());

        return $replaces;
    }
}