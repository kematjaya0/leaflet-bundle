<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\LeafletBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;

/**
 * Description of StylesheetExtension
 *
 * @author guest
 */
class LeafletMapExtension extends AbstractExtension 
{
    /**
     * 
     * @var Environment
     */
    private $twig;
    
    public function __construct(Environment $twig) 
    {
        $this->twig = $twig;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('leaflet_render', [$this, 'render'], ['is_safe' => ['html']]),
            new TwigFunction('leaflet_stylesheet', [$this, 'stylesheet'], ['is_safe' => ['html']]),
            new TwigFunction('leaflet_javascript', [$this, 'javascript'], ['is_safe' => ['html']]),
            new TwigFunction('leaflet_map_javascript', [$this, 'renderMapJS'], ['is_safe' => ['html']]),
        ];
    }
    
    public function stylesheet(string $dom = '#map', string $width = '100%', string $height = '350px')
    {
        return $this->twig->render('@Leaflet/stylesheets.twig', [
            'dom' => $dom, 'width' => $width,
            'height' => $height
        ]);
    }
    
    public function javascript()
    {
        return $this->twig->render('@Leaflet/javascripts.twig');
    }
    
    public function render(string $dom = 'map', string $locationPoint = null)
    {
        return $this->twig->render('@Leaflet/map.twig', [
            'dom' => $dom,
            'locationPoint' => $locationPoint,
        ]);
    }
    
    public function renderMapJS(string $dom = 'map', string $locationPoint = null)
    {
        return $this->twig->render('@Leaflet/map_js.twig', [
            'dom' => $dom,
            'zoom' => 11,
            'locationPoint' => $locationPoint,
            'zoomHome' => null !== $locationPoint ? $locationPoint : '-7.11092982443696, 112.4210759355084',
            'centerMap' => '-7.293421341699741, 112.73709354459358',
            'mapBoxToken' => 'pk.eyJ1Ijoia2VtYXRqYXlhMCIsImEiOiJja3g3YnVuOXYzMHR1MzBybnpwOXdzcHEyIn0.6SHN_wm_7OYl0Zyi6I0ARg'
        ]);
    }
}
