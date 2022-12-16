<?php

namespace Kematjaya\LeafletBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
    
    /**
     * 
     * @var ParameterBagInterface
     */
    private $parameterBag;
    
    public function __construct(Environment $twig, ParameterBagInterface $parameterBag) 
    {
        $this->twig = $twig;
        $this->parameterBag = $parameterBag;
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
        $configs = $this->getLeafletConfigurations();
        return $this->twig->render('@Leaflet/map_js.twig', [
            'dom' => $dom,
            'zoom' => $configs['map']['zoom_value'],
            'min_zoom' => $configs['map']['min_zoom'],
            'max_zoom' => $configs['map']['max_zoom'],
            "on_click_zoom" => $configs["map"]["on_click_zoom"],
            "is_lock" => $configs["map"]["lock_map"],
            "lock_southwest_point" => null !== $configs["map"]["lock_coordinates"]["southwest"] ? $configs["map"]["lock_coordinates"]["southwest"]: $configs['map']['center_point'],
            "lock_northeast_point" => null !== $configs["map"]["lock_coordinates"]["northeast"] ? $configs["map"]["lock_coordinates"]["northeast"]: $configs['map']['center_point'],
            'locationPoint' => $locationPoint,
            'zoomHome' => null !== $locationPoint ? $locationPoint : $configs['map']['zoom_point'],
            'centerMap' => $configs['map']['center_point'],
            'mapBoxToken' => $configs['map_box']['api_token'],
        ]);
    }
    
    protected function getLeafletConfigurations():array
    {
        return $this->parameterBag->get('leaflet');
    }
}
