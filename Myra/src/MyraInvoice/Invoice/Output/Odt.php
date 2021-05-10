<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output;

use App\MyraInvoice\Invoice\Output\Result\DiskDataFolderOutputResult;
use App\MyraInvoice\Invoice\Template\ResultInvoice;
use App\MyraInvoice\Invoice\Template\TemplateFormat;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * DiskDataFolder
 *
 * @package App\MyraInvoice\Invoice\Storage
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class Odt implements InvoiceOutputInterface
{
    private string $invoicesRoot;

    public function __construct(KernelInterface $kernel)
    {
        $this->invoicesRoot = $kernel->getProjectDir() . '/data/invoices';
    }

    public function output(ResultInvoice $resultInvoice): OutputResultInterface
    {
        $outputFilename = sprintf(
            '%s/%s.odt',
            $this->invoicesRoot,
            $resultInvoice->getCalculatorResult()->getInvoiceNumber()
        );

        // Write data to output filename
        switch ($resultInvoice->getFormat()) {
            case TemplateFormat::ODT:
                $this->outputOdt($resultInvoice, $outputFilename);

                break;
            case TemplateFormat::PDF:
                throw new \LogicException('Not implemented');

                break;
        }

        return new DiskDataFolderOutputResult($outputFilename);
    }

    private function outputOdt(ResultInvoice $resultInvoice, string $outputFilename): void
    {
        if ($resultInvoice->getContentType() !== ResultInvoice::CONTENT_TYPE_ZIP) {
            throw new \LogicException('Zip file is expected for ODT template');
        }

        // Check if target directory exists and create if not
        $dir = dirname($outputFilename);

        if (!file_exists($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        // Wih Odt template we have a path to temporary zip file in content field
        // Copy temp file to required target and remove it
        if (!copy($resultInvoice->getContent(), $outputFilename)) {
            throw new IOException(sprintf(
                'Could not copy file %s to %s',
                $resultInvoice->getContent(),
                $outputFilename
            ));
        }
    }
}