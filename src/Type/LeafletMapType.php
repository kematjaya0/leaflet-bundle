<?php

namespace Kematjaya\LeafletBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of LeafletMapType
 *
 * @author guest
 */
class LeafletMapType extends AbstractType 
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'leaflet_map';
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars["map"] = ["width" => $options["map_width"], "height" => $options["map_height"]];
        $view->vars['dom'] = sprintf("%s_map", $view->vars['id']);
        $view->vars['locationPoint'] = $view->vars['value'];
        $view->vars['attr'] = array_merge(['readonly' => true], $view->vars['attr']);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined(['map_width', 'map_height']);
        $resolver->setDefaults([
            'map_width' => "100%",
            'map_height' => "350px"
        ]);
    }
}
