<?php

namespace Kematjaya\LeafletBundle\Tests;

use Kematjaya\LeafletBundle\Type\LeafletMapType;
use PHPUnit\Framework\TestCase;

class LeafletMapTypeTest extends TestCase
{
    public function testGetBlockPrefix(): void
    {
        $type = new LeafletMapType();
        $this->assertEquals('leaflet_map', $type->getBlockPrefix());
    }

    public function testGetParent(): void
    {
        $type = new LeafletMapType();
        $this->assertEquals('Symfony\Component\Form\Extension\Core\Type\TextType', $type->getParent());
    }

    public function testConfigureOptions(): void
    {
        $type = new LeafletMapType();
        $resolver = new \Symfony\Component\OptionsResolver\OptionsResolver();
        $type->configureOptions($resolver);
        
        $options = $resolver->resolve([]);
        
        $this->assertEquals('100%', $options['map_width']);
        $this->assertEquals('350px', $options['map_height']);
    }
}