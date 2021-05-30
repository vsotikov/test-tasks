<?php
declare(strict_types = 1);

namespace Logger;

use Psr\Log\LogLevel as PsrLogLevel;

/**
 * LogLevel
 */
class LogLevel
{
    const EMERGENCY = 800;
    const ALERT     = 700;
    const CRITICAL  = 600;
    const ERROR     = 500;
    const WARNING   = 400;
    const NOTICE    = 300;
    const INFO      = 200;
    const DEBUG     = 100;

    public const LEVEL_TO_PSR = [
        self::DEBUG => PsrLogLevel::DEBUG,
        self::INFO => PsrLogLevel::INFO,
        self::NOTICE => PsrLogLevel::NOTICE,
        self::WARNING => PsrLogLevel::WARNING,
        self::ERROR => PsrLogLevel::ERROR,
        self::CRITICAL => PsrLogLevel::CRITICAL,
        self::ALERT => PsrLogLevel::ALERT,
        self::EMERGENCY => PsrLogLevel::EMERGENCY,
    ];

    public static function psrToLevel(string $psrLevel): int
    {
        $levels = array_flip(self::LEVEL_TO_PSR);

        if (!isset($levels[$psrLevel])) {
            throw new \UnexpectedValueException('PSR level ' . $psrLevel . ' does not have a match with level');
        }

        return $levels[$psrLevel];
    }

    public static function levelToPsr(int $level): string
    {
        if (!isset(self::LEVEL_TO_PSR[$level])) {
            throw new \UnexpectedValueException('Level ' . $level . ' does not have a match with PSR level');
        }

        return self::LEVEL_TO_PSR[$level];
    }
}