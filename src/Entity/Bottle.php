<?php

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

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return $this->company . ' ' . $this->brand;
    }

    public function __construct() {
        parent::__construct();
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
     * @param \App\Entity\Location|null $packagingLocation
     *
     * @return Bottle
     */
    public function setPackagingLocation(\App\Entity\Location $packagingLocation = null)
    {
        $this->packagingLocation = $packagingLocation;

        return $this;
    }

    /**
     * Get packagingLocation.
     *
     * @return \App\Entity\Location|null
     */
    public function getPackagingLocation()
    {
        return $this->packagingLocation;
    }
}
