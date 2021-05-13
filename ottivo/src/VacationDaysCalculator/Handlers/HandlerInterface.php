<?php
declare(strict_types = 1);

require_once 'src/DataSource/Entity/Employer.php';

/**
 * HandlerInterface
 *
 * @package ${NAMESPACE}
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;

    public function handle(Employer $employer, int $year, float $initialDays = 0): float;
}