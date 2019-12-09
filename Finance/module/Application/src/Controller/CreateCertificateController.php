<?php
declare(strict_types = 1);

namespace Application\Controller;

use Application\Form\CreateCertificateForm;
use Application\Model\Table\CertificateTable;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * CreateController
 *
 * @package Application\Controller
 */
class CreateCertificateController extends AbstractActionController
{
    private $form;
    private $certificateTable;

    public function __construct(CreateCertificateForm $form, CertificateTable $certificateTable)
    {
        $this->form = $form;
        $this->certificateTable = $certificateTable;
    }

    public function indexAction(): array
    {
        $error = '';

        if ($this->request->isPost()) {
            try {
                $data = $this->prepareData($this->request->getPost()->toArray());

                $this->form->setData($data);

                if (!$this->form->isValid()) {
                    throw new \LogicException('Form is invalid. Please fix errors.');
                }

                // Store
                $this->certificateTable->create(
                    $this->form->getData()
                );

                // Redirect
                $this->redirect()->toRoute('home');
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }
        }

        return [
            'form' => $this->form,
            'error' => $error,
        ];
    }

    /**
     * Prepare form data
     *
     * @param array $data
     * @return array
     */
    private function prepareData(array $data): array
    {
        if (empty($data['type'])) {
            $data['type'] = null;
        }

        return $data;
    }
}