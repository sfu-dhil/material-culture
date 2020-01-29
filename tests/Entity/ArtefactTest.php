<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Artefact;
use PHPUnit\Framework\TestCase;

class ArtefactTest extends TestCase {
    /**
     * @var Artefact
     */
    private $artefact;

    public function testAddCatalogNumberEmpty() {
        $this->artefact->addCatalogNumber('abc');
        static::assertEquals(array('abc'), $this->artefact->getCatalogNumbers());
    }

    public function testAddCatalogNumber() {
        $this->artefact->addCatalogNumber('abc');
        $this->artefact->addCatalogNumber('def');
        static::assertEquals(array('abc', 'def'), $this->artefact->getCatalogNumbers());
    }

    public function testAddCatalogNumberSorted() {
        $this->artefact->addCatalogNumber('def');
        $this->artefact->addCatalogNumber('abc');
        static::assertEquals(array('abc', 'def'), $this->artefact->getCatalogNumbers());
    }

    public function testSetCatalogNumbers() {
        $this->artefact->setCatalogNumbers(array('abc', 'def'));
        static::assertEquals(array('abc', 'def'), $this->artefact->getCatalogNumbers());
    }

    public function testSetCatalogNumbersSorted() {
        $this->artefact->setCatalogNumbers(array('def', 'abc'));
        static::assertEquals(array('abc', 'def'), $this->artefact->getCatalogNumbers());
    }

    public function testAddDuplicateCatalogNumber() {
        $this->artefact->addCatalogNumber('abc');
        $this->artefact->addCatalogNumber('abc');
        static::assertEquals(array('abc'), $this->artefact->getCatalogNumbers());
    }

    public function testSetDuplicateCatalogNumbers() {
        $this->artefact->setCatalogNumbers(array('abc', 'def', 'abc'));
        static::assertEquals(array('abc', 'def'), $this->artefact->getCatalogNumbers());
    }

    protected function setUp() : void {
        parent::setUp();
        $this->artefact = new class() extends Artefact {
            public function __toString() {
                return 'dummy';
            }

            public function getCategory() {
                return 'dummy';
            }
        };
    }
}
