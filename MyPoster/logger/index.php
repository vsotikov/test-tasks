<?php
chdir(dirname(__DIR__));

require __DIR__ . '/vendor/autoload.php';

$array = [];

for ($i = 0; $i < 100; $i++) {
	$array[] = rand(0, 300);
}

$ascii = new AsciiArray($array);

if ($ascii instanceof \Psr\Log\LoggerAwareInterface) {
    $ascii->setLogger(new \Logger\Logger(
        'asciiarray',
        [
            (new \Logger\Handler\StreamHandler())->setLevel(
                \Psr\Log\LogLevel::INFO
            )->setFormatter(
                new \Logger\Formatter\LineFormatter()
            ),
            (new \Logger\Handler\MysqlDbHandler())->setLevel(
                \Psr\Log\LogLevel::CRITICAL
            ),
        ],
        [
            new \Logger\Processor\PsrLogMessageProcessor(),
        ]
    ));
}

$ascii->validateArray();
