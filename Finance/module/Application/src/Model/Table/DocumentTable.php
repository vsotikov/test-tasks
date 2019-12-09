<?php
declare(strict_types = 1);

namespace Application\Model\Table;

use Application\Model\Entity\Document;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * DocumentTable
 *
 * @package Application\Model\Table
 */
class DocumentTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return Document[]
     */
    public function fetchAll(): array
    {
        $rowset = [];

        foreach ($this->tableGateway->select() as $row) {
            $rowset[] = $row;
        }

        return $rowset;
    }
}