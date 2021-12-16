<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\LeafletBundle\Calculator;

/**
 * distance calculate base haversine method 
 * reference: 
 * https://www.movable-type.co.uk/scripts/latlong.html
 * https://en.wikipedia.org/wiki/Haversine_formula
 * https://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
 *
 * @author guest
 */
class HaversineCalculator implements DistanceCalculatorInterface 
{
    /**
     * 
     * @var float
     */
    private $pi;
    
    /**
     * 
     * @var float
     */
    const EARTH_RADIUS = 6371;
    
    public function __construct() 
    {
        $this->pi = pi();
    }
    
    public function getDistance(Point $pointA, Point $pointB):float
    {
        $radianLatA = $this->getRadians(
                $pointA->getLatitude()
            );
        $radianLatB = $this->getRadians(
            $pointB->getLatitude()
        );
        $radianLat = $this->getRadians(
            $pointB->getLatitude() - $pointA->getLatitude()
        );
        $radianLong = $this->getRadians(
            $pointB->getLongitute() - $pointA->getLongitute()
        );
        
        $a = (sin($radianLat/2) * sin($radianLat/2)) 
                + (cos($radianLatA) * cos($radianLatB)) 
                * (sin($radianLong/2) * sin($radianLong/2));
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return round(self::EARTH_RADIUS * $c, 2);
    }
    
    protected function getRadians(float $x):float
    {
        return $x * ($this->pi / 180);
    }

}
