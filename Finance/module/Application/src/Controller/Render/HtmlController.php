<?php
declare(strict_types = 1);

namespace Application\Controller\Render;

use Application\Certificate\Factory\CertificateFactory;
use Application\Model\Table\CertificateTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * HtmlController
 *
 * @package Application\Controller\Render
 */
class HtmlController extends AbstractActionController
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
     * HtmlController constructor.
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
}