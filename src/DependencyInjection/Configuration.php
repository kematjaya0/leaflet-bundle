<?php

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
                    ->booleanNode("lock_map")
                        ->defaultValue(true)
                    ->end()
                    ->arrayNode('lock_coordinates')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('southwest')
                                ->defaultNull()
                            ->end()
                            ->scalarNode('northeast')
                                ->defaultNull()
                            ->end()
                        ->end()
                    ->end()
                    ->scalarNode('min_zoom')
                        ->defaultValue(8)
                    ->end()
                    ->scalarNode('max_zoom')
                        ->defaultValue(18)
                    ->end()
                    ->scalarNode('center_point')
                        ->defaultValue('-7.293421341699741, 112.73709354459358')
                    ->end()
                    ->scalarNode('zoom_point')
                        ->defaultValue('-7.293421341699741, 112.73709354459358')
                    ->end()
                    ->scalarNode('zoom_value')
                        ->defaultValue(11)
                    ->end()
                    ->scalarNode('on_click_zoom')
                        ->defaultValue(14)
                    ->end()
                ->end()
            ->end();
    }
}
