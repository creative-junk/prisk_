<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 5/19/2017
 * Time: 5:02 PM
 ********************************************************************************/

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Builder implements ContainerAwareInterface
{
      use ContainerAwareTrait;

      public function mainUserMenu(FactoryInterface $factory,array $options){

          $menu = $factory->createItem('root');

          $menu->addChild('Home',array('route'=>'home'));

          $menu->addChild('My Recordings',array('route'=>'my-recordings'));
          $menu['My Recordings']->addChild('New Recording',array('route'=>'add-recording'));

          $menu->addChild('Next of Kin',array('route'=>'my-next-of-kin'));
          $menu['Next of Kin']->addChild('Add Next of Kin',array('route'=>'add-next-of-kin'));

          $menu->addChild('My Profile',array('route'=>'edit-profile'));
          $menu->addChild('Logout',array('route'=>'user_logout'));

          return $menu;
      }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        // TODO: Implement setContainer() method.
    }
}