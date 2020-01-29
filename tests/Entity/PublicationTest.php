<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tests\Entity;

use App\Entity\Publication;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase {
    /**
     * @var Publication
     */
    private $publication;

    public function testAddUrlEmpty() : void {
        $this->publication->AddUrl('http://example.com');
        static::assertSame(['http://example.com'], $this->publication->getUrls());
    }

    public function testAddUrl() : void {
        $this->publication->AddUrl('http://example.com');
        $this->publication->AddUrl('http://some-other-example.com');
        static::assertSame(['http://example.com', 'http://some-other-example.com'], $this->publication->getUrls());
    }

    public function testSetUrls() : void {
        $this->publication->SetUrls(['http://example.com', 'http://some-other-example.com']);
        static::assertSame(['http://example.com', 'http://some-other-example.com'], $this->publication->getUrls());
    }

    public function testAddDuplicateUrl() : void {
        $this->publication->AddUrl('http://example.com');
        $this->publication->AddUrl('http://example.com');
        static::assertSame(['http://example.com'], $this->publication->getUrls());
    }

    public function testSetDuplicateUrls() : void {
        $this->publication->SetUrls(['http://example.com', 'http://some-other-example.com', 'http://example.com']);
        static::assertSame(['http://example.com', 'http://some-other-example.com'], $this->publication->getUrls());
    }

    protected function setUp() : void {
        parent::setUp();
        $this->publication = new Publication();
    }
}
