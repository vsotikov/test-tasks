<?php
declare(strict_types = 1);

namespace Application\Controller\Render;

use Application\Certificate\Factory\CertificateFactory;
use Application\Model\Table\CertificateTable;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface;
use Zend\View\Model\ViewModel;

/**
 * XmlController
 *
 * @package Application\Controller\Render
 */
class XmlController extends AbstractActionController
{
    /**
     * certificateTable
     *
     * @var CertificateTable
     */
    private $certificateTable;

    /**
     * certificateFactory
     *
     * @var CertificateFactory
     */
    private $certificateFactory;

    /**
     * XmlController constructor.
     *
     * @param CertificateTable $certificateTable
     * @param CertificateFactory $certificateFactory
     */
    public function __construct(CertificateTable $certificateTable, CertificateFactory $certificateFactory)
    {
        $this->certificateTable = $certificateTable;
        $this->certificateFactory = $certificateFactory;
    }

    /**
     * @return ViewModel
     */
    public function indexAction(): array
    {
        $id = (int)$this->params()->fromRoute('id');

        $model = $this->certificateTable->get($id);

        if (!$model) {
            throw new \InvalidArgumentException('Invalid certificate id');
        }

        return [
            'certificate' => $this->certificateFactory->create($model),
        ];
    }

    /**
     * @return Response
     */
    public function originalAction(): ResponseInterface
    {
        $id = (int)$this->params()->fromRoute('id');

        $model = $this->certificateTable->get($id);

        if (!$model) {
            throw new \InvalidArgumentException('Invalid certificate id');
        }

        $certificate = $this->certificateFactory->create($model);

        $response = clone $this->response;
        $response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
        $response->setContent(
            $certificate->toXml()->saveXML()
        );

        return $response;
    }
}