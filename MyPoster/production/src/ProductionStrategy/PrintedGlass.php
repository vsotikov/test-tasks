<?php
declare(strict_types = 1);

namespace MP\ProductionStrategy;

use MP\State;

/**
 * PrintedGlass
 *
 * @package MP\ProductionStrategy
 */
class PrintedGlass extends StateSequenceBasedStrategy
{
    public function __construct()
    {
        // Define states sequence
        $this->stateSequence = new \SplQueue();
        $this->stateSequence->push(new State\Ordered());
        $this->stateSequence->push(new State\Printed());
        $this->stateSequence->push(new State\GiftWrapped());
        $this->stateSequence->push(new State\Shipped());

        // Define enabled by default states
        $this->enabledStates = [
            new State\Ordered(),
            new State\Printed(),
            new State\Shipped(),
        ];

        $this->enabledStates = array_combine(
            array_map(
                static fn($state) => get_class($state),
                $this->enabledStates
            ),
            $this->enabledStates
        );
    }
}