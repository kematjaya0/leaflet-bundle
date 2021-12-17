<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\LeafletBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Description of Configuration
 *
 * @author guest
 */
class Configuration implements ConfigurationInterface 
{
    public function getConfigTreeBuilder(): TreeBuilder 
    {
        $treeBuilder = new TreeBuilder('leaflet');
        $rootNode = $treeBuilder->getRootNode();
        
        $this->addChildConfiguration($rootNode->children());
        
        return $treeBuilder;
    }

    protected function addChildConfiguration(NodeBuilder $node)
    {
        $node
            ->arrayNode('map_box')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('api_token')
                        ->defaultNull()
                    ->end()
                ->end()
            ->end()
            ->arrayNode('map')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('center_point')
                        ->defaultValue('-7.293421341699741, 112.73709354459358')
                    ->end()
                    ->scalarNode('zoom_point')
                        ->defaultValue('-7.293421341699741, 112.73709354459358')
                    ->end()
                    ->scalarNode('zoom_value')
                        ->defaultValue(11)
                    ->end()
                ->end()
            ->end();
    }
}
