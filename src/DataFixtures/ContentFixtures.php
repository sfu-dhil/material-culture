<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class ContentFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $item1 = new Content();
        $item1->setName('pickled-cucumber');
        $item1->setLabel('Pickled Cucumber');
        $item1->setDescription('Also known as "pickles." Preserved vegetable in brine or vinegar.');
        $this->addReference('_reference_Content1', $item1);
        $manager->persist($item1);

        $item2 = new Content();
        $item2->setName('pickle-mix');
        $item2->setLabel('Pickle mix');
        $item2->setDescription('Mixture of vegetables in brine or vinegar.');
        $this->addReference('_reference_Content2', $item2);
        $manager->persist($item2);

        $item3 = new Content();
        $item3->setName('fruit-jam');
        $item3->setLabel('Fruit Jam');
        $item3->setDescription('Cooked fruit and sugar.');
        $this->addReference('_reference_Content3', $item3);
        $manager->persist($item3);

        $item4 = new Content();
        $item4->setName('candy');
        $item4->setLabel('Candy');
        $item4->setDescription('Sugary sweetums');
        $this->addReference('_reference_Content4', $item4);
        $manager->persist($item4);

        $item5 = new Content();
        $item5->setName('peanut-butter');
        $item5->setLabel('Peanut butter');
        $item5->setDescription('Something made by a monster.');
        $this->addReference('_reference_Content5', $item5);
        $manager->persist($item5);

        $manager->flush();
    }
}
