<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Template;

use App\MyraInvoice\Invoice\Template\Format;
use Psr\Container\ContainerInterface;

/**
 * TemplateFactory
 *
 * @package App\MyraInvoice\Invoice\Template
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class TemplateFactory
{
    private const PROCESSORS = [
        TemplateFormat::ODT => Format\Odt::class,
        TemplateFormat::PDF => Format\Pdf::class,
    ];

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function create(string $format): InvoiceTemplateInterface
    {
        $processor = self::PROCESSORS[$format] ?? null;

        if ($processor === null) {
            throw new \InvalidArgumentException('Template format ' . $format . ' is not supported');
        }

        return $this->container->get($processor);
    }
}