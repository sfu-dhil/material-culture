<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tests\Entity;

use App\Entity\Artefact;
use PHPUnit\Framework\TestCase;

class ArtefactTest extends TestCase
{
    /**
     * @var Artefact
     */
    private $artefact;

    public function testAddCatalogNumberEmpty() : void {
        $this->artefact->addCatalogNumber('abc');
        static::assertSame(['abc'], $this->artefact->getCatalogNumbers());
    }

    public function testAddCatalogNumber() : void {
        $this->artefact->addCatalogNumber('abc');
        $this->artefact->addCatalogNumber('def');
        static::assertSame(['abc', 'def'], $this->artefact->getCatalogNumbers());
    }

    public function testAddCatalogNumberSorted() : void {
        $this->artefact->addCatalogNumber('def');
        $this->artefact->addCatalogNumber('abc');
        static::assertSame(['abc', 'def'], $this->artefact->getCatalogNumbers());
    }

    public function testSetCatalogNumbers() : void {
        $this->artefact->setCatalogNumbers(['abc', 'def']);
        static::assertSame(['abc', 'def'], $this->artefact->getCatalogNumbers());
    }

    public function testSetCatalogNumbersSorted() : void {
        $this->artefact->setCatalogNumbers(['def', 'abc']);
        static::assertSame(['abc', 'def'], $this->artefact->getCatalogNumbers());
    }

    public function testAddDuplicateCatalogNumber() : void {
        $this->artefact->addCatalogNumber('abc');
        $this->artefact->addCatalogNumber('abc');
        static::assertSame(['abc'], $this->artefact->getCatalogNumbers());
    }

    public function testSetDuplicateCatalogNumbers() : void {
        $this->artefact->setCatalogNumbers(['abc', 'def', 'abc']);
        static::assertSame(['abc', 'def'], $this->artefact->getCatalogNumbers());
    }

    protected function setUp() : void {
        parent::setUp();
        $this->artefact = new class() extends Artefact {
            public function __toString() : string {
                return 'dummy';
            }

            public function getCategory() {
                return 'dummy';
            }
        };
    }
}
