<?php
declare(strict_types = 1);

namespace Application\Form;

use Application\Certificate\BaseCertificate;
use Application\Model\Entity\Certificate;
use Zend\Form\Element;
use Zend\Form\Form;

/**
 * CreateForm
 *
 * @package Application\Form
 */
class CreateCertificateForm extends Form
{
    /**
     * Initialize form
     */
    public function init(): void
    {
        // type
        $valueOptions = [
            Certificate::TYPE_BONUS,
            Certificate::TYPE_GUARANTEE,
        ];

        $this->add([
            'type' => Element\Select::class,
            'name' => 'type',
            'options' => [
                'label' => 'Type',
                'allow_empty' => true,
                'empty_option' => 'Please choose certificate type',
                'value_options' => array_combine(
                    $valueOptions,
                    array_map(
                        static function ($value) {
                            return BaseCertificate::DISPLAY_TYPE[$value] ?? $value;
                        },
                        $valueOptions
                    )
                ),
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'Type',
            ],
        ]);

        // isin
        $this->add([
            'type' => Element\Text::class,
            'name' => 'isin',
            'options' => [
                'label' => 'ISIN',
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'ISIN',
            ],
        ]);

        // trading market
        $this->add([
            'type' => Element\Text::class,
            'name' => 'trading_market',
            'options' => [
                'label' => 'Trading Market',
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'Trading Market',
            ],
        ]);

        // currency
        $valueOptions = [
            Certificate::CURRENCY_EUR,
            Certificate::CURRENCY_GBP,
            Certificate::CURRENCY_USD,
        ];

        $this->add([
            'type' => Element\Select::class,
            'name' => 'currency',
            'options' => [
                'label' => 'Currency',
                'value_options' => array_combine(
                    $valueOptions,
                    array_map(
                        static function ($value) {
                            return BaseCertificate::DISPLAY_CURRENCY[$value] ?? $value;
                        },
                        $valueOptions
                    )
                ),
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'Currency',
            ],
        ]);

        // issuer
        $this->add([
            'type' => Element\Text::class,
            'name' => 'issuer',
            'options' => [
                'label' => 'Issuer',
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'Issuer',
            ],
        ]);

        // issuing price
        $this->add([
            'type' => Element\Number::class,
            'name' => 'issuing_price',
            'options' => [
                'label' => 'Issuing Price',
            ],
            'attributes' => [
                'class' => 'form-control',
                'data-placeholder' => 'Issuing Price',
                'step' => 0.01,
            ],
        ]);

        // submit
        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'value' => 'Create',
            'attributes' => [
                'value' => 'Create',
                'class' => 'btn btn-success',
            ],
        ]);

        // Init filter
        $this->initFilter();
    }

    /**
     * Initialize input filter
     */
    private function initFilter(): void
    {
        $filter = $this->getInputFilter();

        if ($filter) {
            $filter->get('type')->setRequired(true)->setAllowEmpty(true);
            $filter->get('isin')->setRequired(true);
            $filter->get('trading_market')->setRequired(true);
            $filter->get('currency')->setRequired(true);
            $filter->get('issuer')->setRequired(true);
            $filter->get('issuing_price')->setRequired(true);
        }
    }
}