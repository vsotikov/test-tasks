<?php
declare(strict_types = 1);

namespace MP\ProductionStrategy;

use MP\State;

/**
 * FramedPoster
 *
 * @package MP\ProductionStrategy
 */
class FramedPoster extends StateSequenceBasedStrategy
{
    public function __construct()
    {
        // Define states sequence
        $this->stateSequence = new \SplQueue();
        $this->stateSequence->push(new State\Ordered());
        $this->stateSequence->push(new State\Printed());
        $this->stateSequence->push(new State\Sliced());
        $this->stateSequence->push(new State\Framed());
        $this->stateSequence->push(new State\GiftWrapped());
        $this->stateSequence->push(new State\Shipped());

        // Define enabled by default states
        $this->enabledStates = [
            new State\Ordered(),
            new State\Printed(),
            new State\Sliced(),
            new State\Framed(),
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