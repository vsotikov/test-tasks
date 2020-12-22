<?php
declare(strict_types = 1);

namespace App\MyraInvoice\Invoice\Output\Result;

use App\MyraInvoice\Invoice\Output\OutputResultInterface;

/**
 * DiskDataFolderResult
 *
 * @package App\MyraInvoice\Invoice\Storage\Result
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
class DiskDataFolderOutputResult implements OutputResultInterface
{
    private string $outputResultFilename;

    public function __construct(string $outputResultFilename)
    {
        $this->outputResultFilename = $outputResultFilename;
    }

    public function __toString(): string
    {
        return $this->outputResultFilename;
    }
}