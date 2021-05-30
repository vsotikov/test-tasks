<?php

/**
 * Class AsciiArray
 */
class AsciiArray implements \Psr\Log\LoggerAwareInterface
{
    use \Psr\Log\LoggerAwareTrait;

	/**
	 * @var array
	 */
	protected $array;

	/**
	 * AsciiArray constructor.
	 * @param array $array
	 */
	public function __construct(array $array)
	{
		$this->array = $array;
	}

	/**
	 * Validate array of ascii characters.
	 * @throws Exception
	 */
	public function validateArray()
	{
		foreach ($this->array as $pos => $entry) {

			try {
				$this->checkIfEntryIsValid($entry);
			} catch (Exception $e) {
				// TODO: log the exception including the $entry and the position of $entry in $array
                if ($this->logger) {
                    $this->logger->critical(
                        "An exception caught in entry [{entryPos}] {entry}:\n{exception}.",
                        [
                            'exception' => $e,
                            'entryPos' => $pos,
                            'entry' => $entry,
                        ]
                    );
                }

				continue;
			}

			switch (true) {
                case ($entry <= 31):
					// TODO: log a control character
                    if ($this->logger) {
                        $this->logger->info(
                            'Control character [{entryPos}] {entry}',
                            [
                                'entryPos' => $pos,
                                'entry' => $entry,
                            ]
                        );
                    }

                    // As of PHP 8.0
                    // $this?->logger->info('Control character [{entryPos}] {entry}', ...);

					break;
				case ($entry <= 47 || ($entry >= 58 && $entry <= 64) || ($entry >= 91 && $entry <= 96) || ($entry >= 123)):
					// TODO: log a special character
                    if ($this->logger) {
                        $this->logger->info(
                            'Special character [{entryPos}] {entry}',
                            [
                                'entryPos' => $pos,
                                'entry' => $entry,
                            ]
                        );
                    }

					break;
				case ($entry <= 57):
					// TODO: log a numeric character
                    if ($this->logger) {
                        $this->logger->info(
                            'Numeric character [{entryPos}] {entry}',
                            [
                                'entryPos' => $pos,
                                'entry' => $entry,
                            ]
                        );
                    }

					break;
				case ($entry <= 90):
					// TODO: log an uppercase character
                    if ($this->logger) {
                        $this->logger->info(
                            'Uppercase character [{entryPos}] {entry}',
                            [
                                'entryPos' => $pos,
                                'entry' => $entry,
                            ]
                        );
                    }

					break;
				case ($entry <= 122):
					// TODO: log a lowercase character
                    if ($this->logger) {
                        $this->logger->info(
                            'Lowercase character [{entryPos}] {entry}',
                            [
                                'entryPos' => $pos,
                                'entry' => $entry,
                            ]
                        );
                    }

					break;
			}
		}
	}

	/**
	 * @param int $entry
	 * @throws Exception
	 */
	protected function checkIfEntryIsValid($entry)
	{
		if ($entry > 255) {
			throw new Exception(sprintf('Invalid Ascii character "%s" found', $entry));
		}
	}
}
