<?php
declare(strict_types = 1);

namespace MP\ProductionStrategy;

use MP\ProductionStrategy\Exception\InvalidStateException;
use MP\State\StateInterface;

/**
 * StateSequenceBasedStrategy
 * Settings should be defined in children classes
 *
 * @package MP\ProductionStrategy
 */
abstract class StateSequenceBasedStrategy implements ProductionStrategyInterface
{
    protected \SplQueue $stateSequence;
    protected array $enabledStates = [];
    protected ?StateInterface $currentState = null;
    protected ?\DateTimeImmutable $currentStateConfirmDate = null;

    /**
     * @inheritDoc
     */
    public function confirmState(StateInterface $state): bool
    {
        // Calculate next possible state
        $nextState = $this->getNextState();
        $nextStateAsString = $nextState === null
            ? null
            : get_class($nextState);

        // If state is not equal to next state throw an exception
        if (get_class($state) !== $nextStateAsString) {
            throw new InvalidStateException();
        }

        // Set current state
        $this->currentState = $state;
        $this->currentStateConfirmDate = new \DateTimeImmutable();

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentState(): ?StateInterface
    {
        return $this->currentState;
    }

    /**
     * @inheritDoc
     */
    public function getNextState(): ?StateInterface
    {
        $nextState = null;

        $currentStateAsString = $this->currentState === null
            ? null
            : get_class($this->currentState);

        $this->stateSequence->rewind();

        while ($this->stateSequence->valid()) {
            $currentState = $this->stateSequence->current();

            // Skip state if it is not enabled
            if (!$this->stateEnabled($currentState)) {
                $this->stateSequence->next();

                continue;
            }

            // We are on initial start. First state from sequence is the next one
            if ($this->currentState === null) {
                $nextState = $currentState;

                break;
            }

            // We are in the middle. Next state after current should be picked
            if (get_class($currentState) === $currentStateAsString) {
                while ($this->stateSequence->valid()) {
                    $this->stateSequence->next();

                    if ($this->stateSequence->valid()) {
                        $currentState = $this->stateSequence->current();

                        if ($this->stateEnabled($currentState)) {
                            $nextState = $currentState;

                            break;
                        }
                    }
                }

                break;
            }

            $this->stateSequence->next();
        }

        return $nextState;
    }

    /**
     * @inheritDoc
     */
    public function hasState(StateInterface $state): bool
    {
        $hasState = false;
        $requestedState = get_class($state);

        $this->stateSequence->rewind();

        while ($this->stateSequence->valid()) {
            $currentState = $this->stateSequence->current();

            if (get_class($currentState) === $requestedState) {
                $hasState = true;

                break;
            }

            $this->stateSequence->next();
        }

        return $hasState;
    }

    /**
     * @inheritDoc
     */
    public function stateEnabled(StateInterface $state): bool
    {
        return isset($this->enabledStates[get_class($state)]);
    }

    /**
     * @inheritDoc
     */
    public function enableState(StateInterface $state): bool
    {
        $this->enabledStates[get_class($state)] = $state;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function disableState(StateInterface $state): bool
    {
        unset($this->enabledStates[get_class($state)]);

        return true;
    }
}