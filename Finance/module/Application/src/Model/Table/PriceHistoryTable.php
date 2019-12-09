<?php
declare(strict_types = 1);

namespace Application\Model\Table;

use Application\Model\Entity\PriceHistory;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * PriceHistoryTable
 *
 * @package Application\Model\Table
 */
class PriceHistoryTable
{
    /**
     * TableGateway
     *
     * @var TableGateway
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Return an array of price history entries for certificate
     *
     * @param int $certificateId
     * @return PriceHistory[]
     */
    public function fetchForCertificateId(int $certificateId): array
    {
        $result = [];

        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo('certificate_id', $certificateId);
        $select->order('datetime asc');

        $resultSet = $this->tableGateway->selectWith($select);

        foreach ($resultSet as $row) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Return price history records count per certificate
     *
     * @return array
     */
    public function fetchCountGroupedByCertificate(): array
    {
        $result = [];

        $select = $this->tableGateway->getSql()->select();

        $select->group('certificate_id');
        $select->columns([
            'certificate_id',
            'count' => new Expression('COUNT(1)')
        ]);

        $resultSet = $this->tableGateway->selectWith($select);

        foreach ($resultSet as $row) {
            $notMappedData = $row->getNotMappedData();

            $result[$row->getCertificateId()] = $notMappedData['count'] ?? 0;
        }

        return $result;
    }
}