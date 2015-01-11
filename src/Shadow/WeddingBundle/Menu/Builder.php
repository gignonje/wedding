<?php

namespace Shadow\WeddingBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(['id' => 'topnav', 'class' => 'sf-menu']);

        $menu->addChild('Les mariés', array('route' => 'homepage'));
        $menu->addChild('Le jour J', array('uri' => '#'));
        $menu->addChild('Infos pratiques', array('route' => 'info'));
        $menu->addChild('Le voyage de noces', array('uri' => '#'));
        $menu->addChild('Contact', array('route' => 'contact'));

        return $menu;
    }
}