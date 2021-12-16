<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Kematjaya\LeafletBundle\Calculator;

use Kematjaya\LeafletBundle\Calculator\Point;

/**
 *
 * @author guest
 */
interface DistanceCalculatorInterface 
{
    public function getDistance(Point $pointA, Point $pointB):float;
}
