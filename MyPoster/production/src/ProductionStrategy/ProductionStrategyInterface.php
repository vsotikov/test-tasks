<?php
declare(strict_types = 1);

namespace MP\ProductionStrategy;

use MP\ProductionStrategy\Exception\InvalidStateException;
use MP\State\StateInterface;

/**
 * ProductionStrategyInterface
 *
 * @package MP\ProductionStrategy
 */
interface ProductionStrategyInterface
{
    /**
     * @param StateInterface $state
     * @return bool
     * @throws InvalidStateException if $state cannot be confirmed
     * @throws \Throwable
     */
    public function confirmState(StateInterface $state): bool;
    public function getCurrentState(): ?StateInterface;
    public function getNextState(): ?StateInterface;

    public function hasState(StateInterface $state): bool;
    public function stateEnabled(StateInterface $state): bool;
    public function enableState(StateInterface $state): bool;
    public function disableState(StateInterface $state): bool;
}