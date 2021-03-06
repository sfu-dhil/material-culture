<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\CircaDate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class CircaDateFixtures extends Fixture {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $item1 = new CircaDate();
        $item1->setValue('1994');
        $item1->setStart(1994);
        $item1->setEnd(1994);
        $this->addReference('_reference_CircaDate1', $item1);
        $manager->persist($item1);

        $item2 = new CircaDate();
        $item2->setValue('c1750');
        $item2->setStart(1750);
        $item2->setStartCirca(true);
        $item2->setEnd(1750);
        $item2->setEndCirca(true);
        $this->addReference('_reference_CircaDate2', $item2);
        $manager->persist($item2);

        $item3 = new CircaDate();
        $item3->setValue('1948');
        $item3->setStart(1948);
        $item3->setEnd(1948);
        $this->addReference('_reference_CircaDate3', $item3);
        $manager->persist($item3);

        $item4 = new CircaDate();
        $item4->setValue('c1850');
        $item4->setStart(1850);
        $item4->setStartCirca(true);
        $item4->setEnd(1850);
        $item4->setEndCirca(true);
        $this->addReference('_reference_CircaDate4', $item4);
        $manager->persist($item4);

        $item5 = new CircaDate();
        $item5->setValue('1997');
        $item5->setStart(1997);
        $item5->setEnd(1997);
        $this->addReference('_reference_CircaDate5', $item5);
        $manager->persist($item5);

        $item6 = new CircaDate();
        $item6->setValue('1941');
        $item6->setStart(1941);
        $item6->setEnd(1941);
        $this->addReference('_reference_CircaDate6', $item6);
        $manager->persist($item6);

        $manager->flush();
    }
}
