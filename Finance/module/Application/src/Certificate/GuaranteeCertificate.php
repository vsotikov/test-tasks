<?php
declare(strict_types = 1);

namespace Application\Certificate;

/**
 * GuaranteeCertificate
 *
 * @package Application\Certificate
 */
class GuaranteeCertificate extends BaseCertificate
{
    /**
     * participationRate
     *
     * @var float
     */
    private $participationRate = 9.99;

    /**
     * @return float
     */
    public function getParticipationRate(): ?float
    {
        return $this->participationRate;
    }

    /**
     * @param float $participationRate
     * @return GuaranteeCertificate
     */
    public function setParticipationRate(float $participationRate): GuaranteeCertificate
    {
        $this->participationRate = $participationRate;

        return $this;
    }

    public function displayAsXml(): string
    {
        throw new \LogicException('Guarantee certificates cannot be rendered in XML');
    }

    public function toXml(): \DOMDocument
    {
        throw new \LogicException('Guarantee certificates cannot be rendered in XML');
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        $data['participation_rate'] = $this->getParticipationRate();

        return $data;
    }
}