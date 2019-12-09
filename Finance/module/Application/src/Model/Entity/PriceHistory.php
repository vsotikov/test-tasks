<?php
declare(strict_types = 1);

namespace Application\Model\Entity;

use Application\Model\EntityAbstract;

/**
 * PriceHistory
 *
 * @package Application\Model\Entity
 */
class PriceHistory extends EntityAbstract
{
    private $id;
    private $certificateId;
    private $price;
    private $datetime;

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
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return PriceHistory
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getDatetime(): ?int
    {
        return $this->datetime;
    }

    /**
     * @param int $datetime
     * @return PriceHistory
     */
    public function setDatetime(?int $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}