<?php
declare(strict_types = 1);

namespace Application\Controller;

use Application\Certificate\Factory\CertificateFactory;
use Application\Model\Table\CertificateTable;
use Application\Model\Table\PriceHistoryTable;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * PriceHistoryController
 *
 * @package Application\Controller
 */
class PriceHistoryController extends AbstractActionController
{
    private $certificateTable;
    private $priceHistoryTable;
    private $certificateFactory;

    public function __construct(
        CertificateTable $certificateTable,
        PriceHistoryTable $priceHistoryTable,
        CertificateFactory $certificateFactory
    ) {
        $this->certificateTable = $certificateTable;
        $this->priceHistoryTable = $priceHistoryTable;
        $this->certificateFactory = $certificateFactory;
    }

    public function indexAction()
    {
        $id = (int)$this->params()->fromRoute('id');

        if (($model = $this->certificateTable->get($id)) === null) {
            throw new \InvalidArgumentException('Invalid certificate ID');
        }

        $certificate = $this->certificateFactory->create($model);

        $priceEntries = $this->priceHistoryTable->fetchForCertificateId($id);

        return [
            'certificate' => $certificate,
            'priceEntries' => $priceEntries,
        ];
    }
}