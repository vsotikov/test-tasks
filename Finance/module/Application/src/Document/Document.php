<?php
declare(strict_types = 1);

namespace Application\Document;

use Application\Model\Entity\Document as DocumentModel;

/**
 * Document
 *
 * @package Application\Document
 */
class Document
{
    private const DISPLAY_TYPE = [
        DocumentModel::TYPE_TERM_SHEET => 'Term Sheet',
    ];

    private const DISPLAY_FORMAT = [
        DocumentModel::FORMAT_PDF => 'PDF',
        DocumentModel::FORMAT_DOCX => 'DOCX',
    ];

    private $model;

    public function __construct(DocumentModel $model)
    {
        $this->model = $model;
    }

    public function getModel(): DocumentModel
    {
        return $this->model;
    }

    public function getDisplayType(): string
    {
        return $this->getDisplayValue('type', $this->model->getType());
    }

    public function getDisplayFormat(): string
    {
        return $this->getDisplayValue('format', $this->model->getFormat());
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
            case 'format':
                $sourceDisplayValues = self::DISPLAY_FORMAT;

                break;
            default:
                $sourceDisplayValues = [];

                break;
        }

        return (string)($sourceDisplayValues[$value] ?? $value);
    }
}