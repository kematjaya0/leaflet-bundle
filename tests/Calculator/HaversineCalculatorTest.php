<?php

namespace Kematjaya\LeafletBundle\Tests;

use Kematjaya\LeafletBundle\Calculator\HaversineCalculator;
use Kematjaya\LeafletBundle\Calculator\Point;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for HaversineCalculator
 */
class HaversineCalculatorTest extends TestCase
{
    private HaversineCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new HaversineCalculator();
    }

    public function testGetDistanceSamePoint(): void
    {
        $pointA = new Point(-7.293421341699741, 112.73709354459358);
        $pointB = new Point(-7.293421341699741, 112.73709354459358);
        
        $distance = $this->calculator->getDistance($pointA, $pointB);
        
        $this->assertEquals(0.0, $distance);
    }

    public function testGetDistanceKnownValues(): void
    {
        // Jakarta to Surabaya approximate coordinates
        $pointA = new Point(-6.2088, 106.8456); // Jakarta
        $pointB = new Point(-7.2575, 112.7521); // Surabaya
        
        $distance = $this->calculator->getDistance($pointA, $pointB);
        
        // Approximate distance ~670km
        $this->assertEqualsWithDelta(670, $distance, 50);
    }

    public function testGetDistanceReverseOrder(): void
    {
        $pointA = new Point(-6.2088, 106.8456);
        $pointB = new Point(-7.2575, 112.7521);
        
        $distance1 = $this->calculator->getDistance($pointA, $pointB);
        $distance2 = $this->calculator->getDistance($pointB, $pointA);
        
        $this->assertEquals($distance1, $distance2);
    }
}