<?php
declare(strict_types = 1);

namespace Application\Certificate;

/**
 * BonusCertificate
 *
 * @package Application\Certificate
 */
class BonusCertificate extends BaseCertificate
{
    /**
     * barrierLevel
     *
     * @var float
     */
    private $barrierLevel = 5;

    /**
     * @return float
     */
    public function getBarrierLevel(): ?float
    {
        return $this->barrierLevel;
    }

    /**
     * @param float $barrierLevel
     * @return BonusCertificate
     */
    public function setBarrierLevel(float $barrierLevel): BonusCertificate
    {
        $this->barrierLevel = $barrierLevel;

        return $this;
    }

    /**
     * Check if barrier level is hit
     *
     * @return bool
     */
    public function isBarrierLevelHit(): bool
    {
        return (float)$this->getModel()->getCurrentPrice() >= (float)$this->getBarrierLevel();
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $data = parent::toArray();

        $data['barrier_level'] = $this->getBarrierLevel();
        $data['barrier_level_hit'] = (int)$this->isBarrierLevelHit();

        return $data;
    }
}