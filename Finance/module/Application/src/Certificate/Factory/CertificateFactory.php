<?php
declare(strict_types = 1);

namespace Application\Certificate\Factory;

use Application\Model\Entity\Certificate as CertificateModel;
use Application\Certificate;
use Zend\View\Renderer\PhpRenderer;

/**
 * CertificateFactory
 *
 * @package Application\Certificate\Factory
 */
class CertificateFactory
{
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function create(CertificateModel $model): Certificate\BaseCertificate
    {
        switch ($model->getType()) {
            case CertificateModel::TYPE_BONUS:
                $certificate = new Certificate\BonusCertificate($model, $this->renderer);

                break;
            case CertificateModel::TYPE_GUARANTEE:
                $certificate = new Certificate\GuaranteeCertificate($model, $this->renderer);

                break;
            default:
                $certificate = new Certificate\BaseCertificate($model, $this->renderer);

                break;
        }

        return $certificate;
    }
}