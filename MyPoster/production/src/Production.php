<?php

namespace MP;

use MP\ProductionStrategy\Exception\InvalidStateException;
use MP\State\StateInterface;

class Production
{
	/**
	 * @param StateInterface $state
	 * @param Article $article
	 * @throws \InvalidArgumentException
	 */
	public function confirmState(StateInterface $state, Article $article)
	{
	    try {
	        $productionStrategy = $article->getProductionStrategy();
            $productionStrategy->confirmState($state);
        } catch (InvalidStateException $e) {
	        $currentState = $productionStrategy->getCurrentState();
	        $nextState = $productionStrategy->getNextState();

            print sprintf(
                "Invalid new state: %s.\nCurrent state: %s.\nPossible next state: %s\n\n",
                get_class($state),
                $currentState === null
                    ? 'Undefined'
                    : get_class($currentState),
                $nextState === null
                    ? 'Undefined'
                    : get_class($nextState)
            );
        } catch (\Throwable $e) {
	        print 'General error: ' . $e->getMessage();
        }
	}
}
