<?php
declare(strict_types = 1);

namespace Application\Certificate;

use Application\Model\Entity\Certificate;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

/**
 * BaseCertificate
 *
 * @package Application\Certificate
 */
class BaseCertificate
{
    public const DISPLAY_TYPE = [
        Certificate::TYPE_BONUS => 'Bonus',
        Certificate::TYPE_GUARANTEE => 'Guarantee',
    ];

    public const DISPLAY_CURRENCY = [
        Certificate::CURRENCY_EUR => 'EUR',
        Certificate::CURRENCY_GBP => 'GBP',
        Certificate::CURRENCY_USD => 'USD',
    ];

    private $model;
    private $renderer;

    public function __construct(Certificate $model, PhpRenderer $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function getModel(): Certificate
    {
        return $this->model;
    }

    public function getDisplayPrice(string $type): string
    {
        $price = '';

        switch ($type) {
            case 'issuing':
                $price = (string)round($this->model->getIssuingPrice(), 2);

                break;
            case 'current':
                $price = (string)round($this->model->getCurrentPrice(), 2);

                break;
        }

        $price .= '&nbsp;' . $this->getDisplayCurrency();

        return $price;
    }

    public function getDisplayCurrency(): string
    {
        return $this->getDisplayValue('currency', $this->model->getCurrency());
    }

    public function getDisplayType(): string
    {
        return $this->getDisplayValue('type', $this->model->getType());
    }

    public function displayAsHtml(): string
    {
        return $this->renderer->render(
            (new ViewModel([
                'data' => $this->toArray(),
            ]))->setTemplate(
                'application/render/html/partial/certificate.phtml'
            )
        );
    }

    public function displayAsXml(): string
    {
        return $this->renderer->render(
            (new ViewModel([
                'document' => $this->toXml(),
            ]))->setTemplate(
                'application/render/xml/partial/certificate.phtml'
            )
        );
    }

    /**
     * Represent certificate in XML format
     *
     * @return \DOMDocument
     */
    public function toXml(): \DOMDocument
    {
        $document = new \DOMDocument('1.0', 'utf-8');

        $certificateNode = $document->createElement('certificate');

        foreach ($this->toArray() as $key => $value) {
            $certificateNode->appendChild(
                $document->createElement($key, (string)$value)
            );
        }

        $document->appendChild($certificateNode);

        return $document;
    }

    /**
     * Return certificate data as array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = $this->model->toArray();

        /**
         * Model's toArray method gives us raw entity data.
         * Here we replace some special attributes with human readable values.
         */
        foreach ($data as $key => $value) {
            $data[$key] = $this->getDisplayValue($key, $value);
        }

        return $data;
    }

    /**
     * Return human readable display value for attribute
     *
     * @param string $what
     * @param int $value
     * @return string
     */
    private function getDisplayValue(string $what, $value): string
    {
        switch ($what) {
            case 'type':
                $sourceDisplayValues = self::DISPLAY_TYPE;

                break;
            case 'currency':
                $sourceDisplayValues = self::DISPLAY_CURRENCY;

                break;
            default:
                $sourceDisplayValues = [];

                break;
        }

        return (string)($sourceDisplayValues[$value] ?? $value);
    }
}