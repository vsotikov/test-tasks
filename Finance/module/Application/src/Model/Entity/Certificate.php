<?php
declare(strict_types = 1);

namespace Application\Model\Entity;

use Application\Model\EntityAbstract;

/**
 * Certificate
 *
 * @package Application\Model\Entity
 */
class Certificate extends EntityAbstract
{
    public const TYPE_BONUS = 100;
    public const TYPE_GUARANTEE = 200;

    public const CURRENCY_GBP = 100;
    public const CURRENCY_EUR = 200;
    public const CURRENCY_USD = 300;

    private $id;
    private $type;
    private $isin;
    private $tradingMarket;
    private $currency;
    private $issuer;
    private $issuingPrice;
    private $currentPrice;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Certificate
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

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
     * @return Certificate
     */
    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getIsin(): ?int
    {
        return $this->isin;
    }

    /**
     * @param int $isin
     * @return Certificate
     */
    public function setIsin(?int $isin): self
    {
        $this->isin = $isin;

        return $this;
    }

    /**
     * @return string
     */
    public function getTradingMarket(): ?string
    {
        return $this->tradingMarket;
    }

    /**
     * @param string $tradingMarket
     * @return Certificate
     */
    public function setTradingMarket(?string $tradingMarket): self
    {
        $this->tradingMarket = $tradingMarket;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrency(): ?int
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     * @return Certificate
     */
    public function setCurrency(?int $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    /**
     * @param string $issuer
     * @return Certificate
     */
    public function setIssuer(?string $issuer): self
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * @return float
     */
    public function getIssuingPrice(): ?float
    {
        return $this->issuingPrice;
    }

    /**
     * @param float $issuingPrice
     * @return Certificate
     */
    public function setIssuingPrice(?float $issuingPrice): self
    {
        $this->issuingPrice = $issuingPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getCurrentPrice(): ?float
    {
        return $this->currentPrice;
    }

    /**
     * @param float $currentPrice
     * @return Certificate
     */
    public function setCurrentPrice(?float $currentPrice): self
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }
}