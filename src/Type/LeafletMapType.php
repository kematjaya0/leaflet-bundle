<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\LeafletBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

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
        $view->vars['dom'] = sprintf("%s_map", $view->vars['id']);
        $view->vars['locationPoint'] = $view->vars['value'];
        $view->vars['attr'] = array_merge(['readonly' => true], $view->vars['attr']);
    }
}
