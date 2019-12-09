<?php
declare(strict_types = 1);

namespace Application\Controller\Factory;

use Application\Controller\CreateCertificateController;
use Application\Form\CreateCertificateForm;
use Application\Model\Table\CertificateTable;
use Psr\Container\ContainerInterface;

/**
 * CreateControllerFactory
 *
 * @package Application\Controller\Factory
 */
class CreateControllerFactory
{
    /**
     * Create controller
     *
     * @param ContainerInterface $container
     * @return CreateCertificateController
     */
    public function __invoke(ContainerInterface $container): CreateCertificateController
    {
        $formManager = $container->get('FormElementManager');

        return new CreateCertificateController(
            $formManager->get(CreateCertificateForm::class),
            $container->get(CertificateTable::class)
        );
    }
}