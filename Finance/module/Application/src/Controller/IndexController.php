<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Document\Document;
use Application\Model\Entity\Certificate;
use Application\Model\Table\CertificateTable;
use Application\Model\Table\DocumentTable;
use Application\Certificate\Factory\CertificateFactory;
use Application\Model\Table\PriceHistoryTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $certificateTable;
    private $documentTable;
    private $certificateFactory;
    private $priceHistoryTable;

    public function __construct(
        CertificateTable $certificateTable,
        DocumentTable $documentTable,
        PriceHistoryTable $priceHistoryTable,
        CertificateFactory $certificateFactory
    ) {
        $this->certificateTable = $certificateTable;
        $this->documentTable = $documentTable;
        $this->certificateFactory = $certificateFactory;
        $this->priceHistoryTable = $priceHistoryTable;
    }

    public function indexAction(): array
    {
        // Fetch Certificates
        $certificates = array_map(
            function (Certificate $model) {
                return $this->certificateFactory->create($model);
            },
            $this->certificateTable->fetchAll()
        );

        // Prepare documents grouped by certificate id
        $documents = [];

        foreach ($this->documentTable->fetchAll() as $document) {
            $documents[$document->getCertificateId()][] = new Document($document);
        }

        $priceHistoryCounts = $this->priceHistoryTable->fetchCountGroupedByCertificate();

        return [
            'certificates' => $certificates,
            'documents' => $documents,
            'priceHistoryCounts' => $priceHistoryCounts,
        ];
    }
}
