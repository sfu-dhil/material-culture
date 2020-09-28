<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bottle.
 *
 * @ORM\Table(name="artefact_bottle")
 * @ORM\Entity(repositoryClass="App\Repository\BottleRepository")
 */
class Bottle extends Artefact {
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $company;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $brand;

    /**
     * @var Manufacturer
     * @ORM\ManyToOne(targetEntity="App\Entity\Manufacturer", inversedBy="bottles")
     */
    private $manufacturer;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="bottlesPacked")
     */
    private $packagingLocation;

    /**
     * @var Content
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="bottles")
     */
    private $content;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() : string {
        $s = implode(' ', array_merge([$this->company, $this->brand], $this->catalogNumbers));
        if(($trimmed = trim($s))) {
            return $trimmed;
        }
        return "Bottle #" . $this->id;
    }

    public function getCategory() {
        return self::BOTTLE;
    }

    /**
     * Set company.
     *
     * @param null|string $company
     *
     * @return Bottle
     */
    public function setCompany($company = null) {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company.
     *
     * @return null|string
     */
    public function getCompany() {
        return $this->company;
    }

    /**
     * Set brand.
     *
     * @param null|string $brand
     *
     * @return Bottle
     */
    public function setBrand($brand = null) {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand.
     *
     * @return null|string
     */
    public function getBrand() {
        return $this->brand;
    }

    /**
     * Set manufacturer.
     *
     * @param null|\App\Entity\Manufacturer $manufacturer
     *
     * @return Bottle
     */
    public function setManufacturer(Manufacturer $manufacturer = null) {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer.
     *
     * @return null|\App\Entity\Manufacturer
     */
    public function getManufacturer() {
        return $this->manufacturer;
    }

    /**
     * Set content.
     *
     * @param null|\App\Entity\Content $content
     *
     * @return Bottle
     */
    public function setContent(Content $content = null) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return null|\App\Entity\Content
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set packagingLocation.
     *
     * @param null|\App\Entity\Location $packagingLocation
     *
     * @return Bottle
     */
    public function setPackagingLocation(Location $packagingLocation = null) {
        $this->packagingLocation = $packagingLocation;

        return $this;
    }

    /**
     * Get packagingLocation.
     *
     * @return null|\App\Entity\Location
     */
    public function getPackagingLocation() {
        return $this->packagingLocation;
    }
}
