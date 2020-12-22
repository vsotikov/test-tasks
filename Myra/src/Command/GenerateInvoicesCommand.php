<?php
declare(strict_types = 1);

namespace App\Command;

use App\MyraInvoice\Customer\CustomersProvider;
use App\MyraInvoice\Invoice\Calculator\Calculator;
use App\MyraInvoice\Invoice\DataSource\InvoiceDataSourceInterface;
use App\MyraInvoice\Invoice\Output\InvoiceOutputInterface;
use App\MyraInvoice\Invoice\Template\TemplateFactory;
use App\MyraInvoice\Invoice\Template\TemplateFormat;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * GenerateInvoicesCommand
 *
 * @package App\Command
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class GenerateInvoicesCommand extends Command
{
    private CustomersProvider $customersProvider;
    private Calculator $invoiceCalculator;
    private InvoiceDataSourceInterface $invoiceDataSource;
    private InvoiceOutputInterface $invoiceOutput;
    private TemplateFactory $templateFactory;

    protected static $defaultName = 'app:generate-invoices';

    public function __construct(
        CustomersProvider $customersProvider,
        Calculator $invoiceCalculator,
        InvoiceDataSourceInterface $invoiceDataSource,
        InvoiceOutputInterface $invoiceOutput,
        TemplateFactory $templateFactory
    ) {
        $this->customersProvider = $customersProvider;
        $this->invoiceCalculator = $invoiceCalculator;
        $this->invoiceDataSource = $invoiceDataSource;
        $this->invoiceOutput = $invoiceOutput;
        $this->templateFactory = $templateFactory;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('format', InputArgument::OPTIONAL, 'Output format. Valid formats are: odt, pdf')
            ->addArgument('from', InputArgument::OPTIONAL, 'Invoice period start date in format: dd.mm.yyyy')
            ->addArgument('to', InputArgument::OPTIONAL, 'Invoice period end date in format: dd.mm.yyyy')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $exitCode = Command::SUCCESS;

        try {
            // Process input
            $format = (string)$input->getArgument('format');
            $from = (string)$input->getArgument('from');
            $to = (string)$input->getArgument('to');

            if (empty($format)) {
                $format = TemplateFormat::ODT;
            }

            if (empty($from)) {
                $from = '01.12.2012';
            }

            if (empty($to)) {
                $to = '31.12.2012';
            }

            $invoicePeriod = [
                'from' => new \DateTimeImmutable($from),
                'to' => new \DateTimeImmutable($to),
            ];

            // Create a template for invoice
            $invoiceTemplate = $this->templateFactory->create($format);

            // Fetch customers
            $customers = $this->customersProvider->getAll();

            // Start preparing invoices
            foreach ($customers as $customer) {
                try {
                    $output->writeln(str_repeat('=', 80));

                    // Generate invoice for customer
                    $invoiceCalculatedResult = $this->invoiceCalculator->calculate(
                        $customer,
                        $this->invoiceDataSource,
                        $invoicePeriod
                    );

                    $output->writeln(sprintf('Invoice for customer %s has been issued', $customer->getName()));

                    if ($invoiceCalculatedResult->shouldBePayed()) {
                        // Generate a visual invoice representation
                        $invoice = $invoiceTemplate->applyInvoice($invoiceCalculatedResult);

                        $output->writeln(sprintf(
                            'Invoice for customer %s has been prepared in %s format',
                            $customer->getName(),
                            mb_strtoupper($invoice->getFormat())
                        ));

                        // Output (disk/mail/print/...) an invoice
                        $outputResult = $this->invoiceOutput->output($invoice);
                        $output->writeln(sprintf('Invoice for customer %s has been output to %s', $customer->getName(), $outputResult));
                    } else {
                        $output->writeln(sprintf('Invoice for customer %s is empty', $customer->getName()));
                    }
                } catch (\Throwable $e) {
                    $output->writeln(sprintf(
                        'An error during processing invoice for customer %s: %s',
                        $customer->getName(),
                        $e->getMessage()
                    ));

                    // Log, notify..
                } finally {
                    $output->writeln(str_repeat('=', 80));
                }
            }
        } catch (\Throwable $e) {
            $output->writeln(sprintf(
                'A general error during processing command: %s',
                $e->getMessage()
            ));

            // Log, notify..
            $exitCode = Command::FAILURE;
        }

        return $exitCode;
    }
}