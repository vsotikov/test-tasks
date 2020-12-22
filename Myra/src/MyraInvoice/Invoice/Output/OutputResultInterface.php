<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output;

/**
 * ResultInterface
 *
 * @package App\MyraInvoice\Invoice\Storage
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
interface OutputResultInterface
{
    public function __toString(): string;
}