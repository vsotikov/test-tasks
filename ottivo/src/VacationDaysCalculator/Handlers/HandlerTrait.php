<?php
declare(strict_types = 1);

require_once 'src/VacationDaysCalculator/Handlers/HandlerInterface.php';

/**
 * HandlerTrait
 *
 * @package ${NAMESPACE}
 * @author Vitali Sotsikau <vitali.sotsikau@check24.de>
 * @copyright CHECK24 GmbH
 */
trait HandlerTrait
{
    private ?HandlerInterface $nextHandler = null;

    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }
}