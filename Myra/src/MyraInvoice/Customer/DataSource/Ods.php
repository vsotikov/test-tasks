<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Customer\DataSource;

use App\MyraInvoice\Customer\Customer;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Csv
 *
 * @package App\MyraInvoice\Customer\DataSource
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Ods implements DataSourceInterface
{
    private string $filename = '/data/Musterkundensatz.ods';

    public function __construct(KernelInterface $kernel)
    {
        $this->filename = $kernel->getProjectDir() . $this->filename;
    }

    public function getCustomers(): array
    {
        $customers = [];

        $zip = new \ZipArchive();

        if ($zip->open($this->filename) === true) {
            if (($index = $zip->locateName('content.xml')) !== false) {
                $document = new \DOMDocument();
                $document->loadXML(
                    $zip->getFromIndex($index),
                    LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING
                );

                // Return XML
                $rows = $document->getElementsByTagName('table-row');
                $header = [];

                /** @var \DOMElement $row */
                foreach ($rows as $i => $row) {
                    if ($i === 0) {
                        // Header
                        foreach ($row->getElementsByTagName('p') as $cell) {
                            $header[] = trim($cell->nodeValue);
                        }

                        continue;
                    }

                    $data = [];

                    foreach ($row->getElementsByTagName('p') as $cell) {
                        $data[] = trim($cell->nodeValue);
                    }

                    $customers[] = new Customer(array_combine(
                        array_intersect_key($header, $data),
                        $data
                    ));
                }
            }

            $zip->close();
        }

        return $customers;
    }
}