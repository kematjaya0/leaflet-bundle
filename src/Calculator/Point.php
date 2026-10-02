<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\LeafletBundle\Calculator;

/**
 * Description of Point
 *
 * @author guest
 */
class Point
{
    public function __construct(private readonly float $latitude, private readonly float $longitute) {}

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitute(): float
    {
        return $this->longitute;
    }
}
