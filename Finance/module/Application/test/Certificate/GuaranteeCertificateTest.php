<?php
declare(strict_types = 1);

namespace Application\ApplicationTest;

use Application\Certificate\GuaranteeCertificate;
use Application\Model\Entity\Certificate;
use PHPUnit\Framework\TestCase;
use Zend\View\Renderer\PhpRenderer;

/**
 * GuaranteeCertificateTest
 *
 * @package Application\Certificate
 * @author Vitali Sotsikau <vsotikov@gmail.com>
 * @copyright
 */
class GuaranteeCertificateTest extends TestCase
{
    public function testDisplayAsXml()
    {
        $model = $this->prophesize(Certificate::class);
        $renderer = $this->prophesize(PhpRenderer::class);

        $certificate = new GuaranteeCertificate(
            $model->reveal(),
            $renderer->reveal()
        );

        $this->expectException(\LogicException::class);

        $certificate->displayAsXml();
    }

    public function testToXml()
    {
        $model = $this->prophesize(Certificate::class);
        $renderer = $this->prophesize(PhpRenderer::class);

        $certificate = new GuaranteeCertificate(
            $model->reveal(),
            $renderer->reveal()
        );

        $this->expectException(\LogicException::class);

        $certificate->displayAsXml();
    }

    public function testHasParticipationRate()
    {
        $model = $this->prophesize(Certificate::class);
        $renderer = $this->prophesize(PhpRenderer::class);

        $model->toArray()->willReturn([]);

        $certificate = new GuaranteeCertificate(
            $model->reveal(),
            $renderer->reveal()
        );

        $this->assertArrayHasKey('participation_rate', $certificate->toArray());
    }
}
