<?php
declare(strict_types = 1);

namespace Logger\Processor;

/**
 * PsrLogMessageProcessor
 */
class PsrLogMessageProcessor implements ProcessorInterface
{
    public function __invoke(array $record): array
    {
        if (strpos($record['message'], '{') === false) {
            return $record;
        }

        $replacements = [];

        foreach ($record['context'] as $key => $val) {
            $placeholder = '{' . $key . '}';

            if (strpos($record['message'], $placeholder) === false) {
                continue;
            }

            if ($val === null || is_scalar($val) || (is_object($val) && method_exists($val, '__toString'))) {
                $replacements[$placeholder] = $val;
            } elseif ($val instanceof \DateTimeInterface) {
                $replacements[$placeholder] = $val->format('Y-m-d\TH:i:s.uP');
            } elseif (is_object($val)) {
                $replacements[$placeholder] = '[object ' . get_class($val) . ']';
            } elseif (is_array($val)) {
                $replacements[$placeholder] = '[array ' . json_encode($val, JSON_PRETTY_PRINT) . ']';
            } else {
                $replacements[$placeholder] = '[' . gettype($val) . ']';
            }
        }

        $record['message'] = strtr($record['message'], $replacements);

        return $record;
    }
}