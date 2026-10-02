<?php

namespace Kematjaya\LeafletBundle\Tests;

use Kematjaya\LeafletBundle\Tests\Fixtures\TestKernel;
use Kematjaya\LeafletBundle\Twig\LeafletMapExtension;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;
use Twig\TwigFunction;

class LeafletMapExtensionTest extends WebTestCase
{
    private LeafletMapExtension $extension;
    private Environment $twig;

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected function setUp(): void
    {
        parent::setUp();

        static::bootKernel();
        $container = static::getContainer();

        $this->twig = $container->get('twig');
        $parameterBag = $container->get(ParameterBagInterface::class);

        $this->extension = new LeafletMapExtension($this->twig, $parameterBag);
    }

    public function testGetFunctions(): void
    {
        $functions = $this->extension->getFunctions();

        $this->assertCount(4, $functions);
        $functionNames = array_map(fn(TwigFunction $f): string => $f->getName(), $functions);
        $this->assertContains('leaflet_render', $functionNames);
        $this->assertContains('leaflet_stylesheet', $functionNames);
        $this->assertContains('leaflet_javascript', $functionNames);
        $this->assertContains('leaflet_map_javascript', $functionNames);
    }

    public function testStylesheet(): void
    {
        $result = $this->extension->stylesheet('#map', '100%', '350px');

        $this->assertIsString($result);
        $this->assertStringContainsString('leaflet', strtolower($result));
    }

    public function testJavascript(): void
    {
        $result = $this->extension->javascript();

        $this->assertIsString($result);
        $this->assertStringContainsString('leaflet', strtolower($result));
    }

    public function testRender(): void
    {
        $result = $this->extension->render('map', '-7.293421341699741, 112.73709354459358');

        $this->assertIsString($result);
        $this->assertStringContainsString('map', $result);
    }

    public function testRenderMapJS(): void
    {
        $result = $this->extension->renderMapJS('map', '-7.293421341699741, 112.73709354459358');

        $this->assertIsString($result);
        $this->assertStringContainsString('map', $result);
    }
}
