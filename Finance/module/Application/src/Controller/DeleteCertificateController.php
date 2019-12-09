<?php
declare(strict_types = 1);

namespace Application\Controller;

use Application\Model\Table\CertificateTable;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * DeleteController
 *
 * @package Application\Controller
 */
class DeleteCertificateController extends AbstractActionController
{
    private $certificateTable;

    public function __construct(CertificateTable $certificateTable)
    {
        $this->certificateTable = $certificateTable;
    }

    public function indexAction(): Response
    {
        $id = (int)$this->params()->fromRoute('id');

        if ($id) {
            $this->certificateTable->delete($id);
        }

        return $this->redirect()->toRoute('home');
    }
}