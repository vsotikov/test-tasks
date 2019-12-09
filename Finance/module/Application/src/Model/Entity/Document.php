<?php
declare(strict_types = 1);

namespace Application\Model\Entity;

use Application\Model\EntityAbstract;

/**
 * Document
 *
 * @package Application\Model\Entity
 */
class Document extends EntityAbstract
{
    public const TYPE_TERM_SHEET = 100;

    public const FORMAT_PDF = 100;
    public const FORMAT_DOCX = 200;

    private $id;
    private $certificateId;
    private $format;
    private $type;
    private $title;
    private $link;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return PriceHistory
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getCertificateId(): ?int
    {
        return $this->certificateId;
    }

    /**
     * @param int $certificateId
     * @return PriceHistory
     */
    public function setCertificateId(?int $certificateId): self
    {
        $this->certificateId = $certificateId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFormat(): ?int
    {
        return $this->format;
    }

    /**
     * @param int $format
     * @return Document
     */
    public function setFormat(?int $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Document
     */
    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Document
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Document
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}