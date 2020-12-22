<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\DataSource;

use App\MyraInvoice\Customer\Customer;
use App\MyraInvoice\Invoice\Output\OutputResultInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Csv
 *
 * @package App\MyraInvoice\Invoice\DataSource
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class Csv implements InvoiceDataSourceInterface
{
    private string $dataFilename = '/data/MyraCache_1.csv';

    public function __construct(KernelInterface $kernel)
    {
        $this->dataFilename = $kernel->getProjectDir() . $this->dataFilename;
    }

    /**
     * @inheritDoc
     */
    public function getForCustomerAndPeriod(Customer $customer, array $period): array
    {
        $result = [];

        if (($handle = fopen($this->dataFilename, 'rb')) !== false) {
            $header = null;

            while (($data = fgetcsv($handle, 0, ';')) !== false) {
                if (!(is_array($data) && count($data) === 4)) {
                    break;
                }

                if ($header === null) {
                    $header = $data;

                    continue;
                }

                $customerDomain = $data[1];
                $datetime = new \DateTimeImmutable($data[0]);

                if ($customerDomain === $customer->getDomain() &&
                    $datetime >= $period['from'] &&
                    $datetime <= $period['to']
                ) {
                    $result[] = [
                        'pi' => (int)$data[2],
                        'datetime' => $datetime,
                    ];
                }
            }

            fclose($handle);
        }

        return $result;
    }
}