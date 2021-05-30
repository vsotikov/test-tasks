<?php
declare(strict_types = 1);

namespace LoggerTest\Handler;

use Logger\Handler\StreamHandler;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

/**
 * StreamHandlerTest
 */
class StreamHandlerTest extends TestCase
{
    public function testIsHandling()
    {
        $handler = new StreamHandler();
        $handler->setLevel(LogLevel::NOTICE);

        $this->assertFalse($handler->isHandling(['level' => LogLevel::DEBUG]));
        $this->assertFalse($handler->isHandling(['level' => LogLevel::INFO]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::NOTICE]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::WARNING]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::ERROR]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::CRITICAL]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::ALERT]));
        $this->assertTrue($handler->isHandling(['level' => LogLevel::EMERGENCY]));
    }
}
