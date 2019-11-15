<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Menu builder for the navigation and search menus.
 */
class Builder implements ContainerAwareInterface {
    use ContainerAwareTrait;

    // U+25BE, black down-pointing small triangle.
    const CARET = ' ▾';

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Build the menu builder.
     *
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authChecker
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authChecker, TokenStorageInterface $tokenStorage) {
        $this->factory = $factory;
        $this->authChecker = $authChecker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Check if the current user is both logged in and granted a role.
     *
     * @param string $role
     *
     * @return bool
     */
    private function hasRole($role) {
        if ( ! $this->tokenStorage->getToken()) {
            return false;
        }

        return $this->authChecker->isGranted($role);
    }

    /**
     * Build the navigation menu and return it.
     *
     * @param array $options
     *
     * @return ItemInterface
     */
    public function mainMenu(array $options) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array(
            'class' => 'nav navbar-nav',
        ));

        $browse = $menu->addChild('browse', array(
            'uri' => '#',
            'label' => 'Explore ' . self::CARET,
        ));
        $browse->setAttribute('dropdown', true);
        $browse->setLinkAttribute('class', 'dropdown-toggle');
        $browse->setLinkAttribute('data-toggle', 'dropdown');
        $browse->setChildrenAttribute('class', 'dropdown-menu');

        $browse->addChild('bottle', array(
            'label' => 'Bottles',
            'route' => 'bottle_index',
        ));

        $browse->addChild('can', array(
            'label' => 'Cans',
            'route' => 'can_index',
        ));

        $browse->addChild('ceramic', array(
            'label' => 'Majolicas',
            'route' => 'ceramic_index',
        ));

        $browse->addChild('image', array(
            'label' => 'Images',
            'route' => 'image_index',
        ));

        $divider1 = $browse->addChild('divider1', array(
            'label' => '',
        ));
        $divider1->setAttributes(array(
            'role' => 'separator',
            'class' => 'divider',
        ));

        $browse->addChild('content', array(
            'label' => 'Contents',
            'route' => 'content_index',
        ));

        $browse->addChild('glaze', array(
            'label' => 'Glazes',
            'route' => 'glaze_index',
        ));

        $browse->addChild('institution', array(
            'label' => 'Institutions',
            'route' => 'institution_index',
        ));

        $browse->addChild('location', array(
            'label' => 'Locations',
            'route' => 'location_index',
        ));

        $browse->addChild('manufacturer', array(
            'label' => 'Manufacturers',
            'route' => 'manufacturer_index',
        ));

        $browse->addChild('publication', array(
            'label' => 'Publications',
            'route' => 'publication_index',
        ));

        $browse->addChild('typology', array(
            'label' => 'Typology',
            'route' => 'typology_index',
        ));

        $browse->addChild('vessel', array(
            'label' => 'Ceramic Vessels',
            'route' => 'vessel_index',
        ));

//        if ($this->hasRole('ROLE_USER')) {
//            $divider = $browse->addChild('divider', array(
//                'label' => '',
//            ));
//            $divider->setAttributes(array(
//                'role' => 'separator',
//                'class' => 'divider',
//            ));
//            $browse->addChild('Admin', array(
//                'uri' => '#',
//            ));
//        }

        return $menu;
    }
}
