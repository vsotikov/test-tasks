<?php
declare(strict_types = 1);

namespace Application\Model\Table;

use Application\Model\Entity\Certificate;
use Zend\Db\RowGateway\RowGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * CertificateTable
 *
 * @package Application\Model\Entity
 */
class CertificateTable
{
    /**
     * tableGateway
     *
     * @var TableGateway
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function get(int $id): ?Certificate
    {
        return $this->tableGateway->select(['id' => $id])->current();
    }

    /**
     * @return Certificate[]
     */
    public function fetchAll(): array
    {
        $rowset = [];

        foreach ($this->tableGateway->select() as $row) {
            $rowset[] = $row;
        }

        return $rowset;
    }

    public function delete(int $id): void
    {
        $this->tableGateway->delete(['id' => $id]);
    }

    /**
     * Craete new certificate
     *
     * @param array $data
     * @return Certificate
     */
    public function create(array $data): Certificate
    {
        $certificate = clone $this->tableGateway->getResultSetPrototype()->getArrayObjectPrototype();
        $certificate->exchangeArray($data);

        // Set current price to issuing price upon create
        $certificate->setCurrentPrice($certificate->getIssuingPrice());

        $this->tableGateway->insert($certificate->toArray());
        $id = $this->tableGateway->getLastInsertValue();

        return $this->get((int)$id);
    }
}