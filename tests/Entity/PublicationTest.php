<?php

namespace App\Tests\Entity;

use App\Entity\Artefact;
use App\Entity\Publication;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase {
    /**
     * @var Publication
     */
    private $publication;

    public function testAddUrlEmpty() {
        $this->publication->AddUrl('http://example.com');
        static::assertEquals(array('http://example.com'), $this->publication->getUrls());
    }

    public function testAddUrl() {
        $this->publication->AddUrl('http://example.com');
        $this->publication->AddUrl('http://some-other-example.com');
        static::assertEquals(array('http://example.com', 'http://some-other-example.com'), $this->publication->getUrls());
    }

    public function testSetUrls() {
        $this->publication->SetUrls(array('http://example.com', 'http://some-other-example.com'));
        static::assertEquals(array('http://example.com', 'http://some-other-example.com'), $this->publication->getUrls());
    }

    public function testAddDuplicateUrl() {
        $this->publication->AddUrl('http://example.com');
        $this->publication->AddUrl('http://example.com');
        static::assertEquals(array('http://example.com'), $this->publication->getUrls());
    }

    public function testSetDuplicateUrls() {
        $this->publication->SetUrls(array('http://example.com', 'http://some-other-example.com', 'http://example.com'));
        static::assertEquals(array('http://example.com', 'http://some-other-example.com'), $this->publication->getUrls());
    }

    protected function setUp() : void {
        parent::setUp();
        $this->publication = new Publication();
    }
}
