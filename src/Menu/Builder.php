<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Menu;

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
    public const CARET = ' ▾';

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
     * @return ItemInterface
     */
    public function mainMenu(array $options) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes([
            'class' => 'nav navbar-nav',
        ]);

        $browse = $menu->addChild('browse', [
            'uri' => '#',
            'label' => 'Explore ' . self::CARET,
        ]);
        $browse->setAttribute('dropdown', true);
        $browse->setLinkAttribute('class', 'dropdown-toggle');
        $browse->setLinkAttribute('data-toggle', 'dropdown');
        $browse->setChildrenAttribute('class', 'dropdown-menu');

        $browse->addChild('bottle', [
            'label' => 'Bottles',
            'route' => 'bottle_index',
        ]);

        $browse->addChild('can', [
            'label' => 'Cans',
            'route' => 'can_index',
        ]);

        $browse->addChild('ceramic', [
            'label' => 'Majolicas',
            'route' => 'ceramic_index',
        ]);

        $browse->addChild('image', [
            'label' => 'Images',
            'route' => 'image_index',
        ]);

        $divider1 = $browse->addChild('divider1', [
            'label' => '',
        ]);
        $divider1->setAttributes([
            'role' => 'separator',
            'class' => 'divider',
        ]);

        $browse->addChild('content', [
            'label' => 'Contents',
            'route' => 'content_index',
        ]);

        $browse->addChild('glaze', [
            'label' => 'Glazes',
            'route' => 'glaze_index',
        ]);

        $browse->addChild('institution', [
            'label' => 'Institutions',
            'route' => 'institution_index',
        ]);

        $browse->addChild('location', [
            'label' => 'Locations',
            'route' => 'location_index',
        ]);

        $browse->addChild('manufacturer', [
            'label' => 'Manufacturers',
            'route' => 'manufacturer_index',
        ]);

        $browse->addChild('publication', [
            'label' => 'Publications',
            'route' => 'publication_index',
        ]);

        $browse->addChild('typology', [
            'label' => 'Typology',
            'route' => 'typology_index',
        ]);

        $browse->addChild('vessel', [
            'label' => 'Ceramic Vessels',
            'route' => 'vessel_index',
        ]);

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
