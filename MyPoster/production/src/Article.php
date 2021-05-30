<?php

namespace MP;

use MP\ProductionStrategy\ProductionStrategyInterface;
use MP\State\GiftWrapped;
use MP\State\StateInterface;

class Article
{
	const TYPE_POSTER_FRAMED = 'poster-framed';
	const TYPE_PRINTED_GLASS = 'printed-glass';

	/**
	 * @var string
	 */
	protected $articleType;

	private ProductionStrategyInterface $productionStrategy;

	/**
	 * Article constructor.
	 * @param string $articleType
	 */
	public function __construct($articleType, ProductionStrategyInterface $productionStrategy)
	{
		$this->validateType($articleType);

		$this->articleType = $articleType;
		$this->productionStrategy = $productionStrategy;
	}

    public function getProductionStrategy(): ProductionStrategyInterface
    {
        return $this->productionStrategy;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->articleType;
	}

	/**
	 * @return $this
	 */
	public function enableGiftWrapping()
	{
	    $state = new GiftWrapped();

	    if ($this->productionStrategy->hasState($state)) {
	        $this->productionStrategy->enableState($state);
        }

		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasGiftWrapping()
	{
        $state = new GiftWrapped();

	    return $this->productionStrategy->hasState($state) &&
            $this->productionStrategy->stateEnabled($state);
	}

	/**
	 * @return ?StateInterface
	 */
	public function getState(): ?StateInterface
	{
	    return $this->productionStrategy->getCurrentState();
	}

	/**
	 * @param string $articleType
	 * @return $this
	 */
	protected function validateType($articleType)
	{
		if (! $this->isTypeValid($articleType)) {
			throw new \InvalidArgumentException(sprintf('unknown article type given: %s', $articleType));
		}

		return $this;
	}

	/**
	 * @param string $articleType
	 * @return bool
	 */
	protected function isTypeValid($articleType)
	{
		return in_array($articleType, self::getTypes());
	}

	/**
	 * @return array
	 */
	public static function getTypes()
	{
		return [
			self::TYPE_POSTER_FRAMED,
			self::TYPE_PRINTED_GLASS,
		];
	}
}
