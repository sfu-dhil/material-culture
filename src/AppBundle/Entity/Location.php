<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Location.
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location extends AbstractTerm {
    /**
     * @var string
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $geonameId;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var Artefact[]|Collection
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="recoveryLocation")
     */
    private $artefactsRecovered;

    /**
     * @var Artefact[]|Collection
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="manufactureLocation")
     */
    private $artefactsManufactured;

    /**
     * Set geonameId.
     *
     * @param null|string $geonameId
     *
     * @return Location
     */
    public function setGeonameId($geonameId = null) {
        $this->geonameId = $geonameId;

        return $this;
    }

    /**
     * Get geonameId.
     *
     * @return null|string
     */
    public function getGeonameId() {
        return $this->geonameId;
    }

    /**
     * Set latitude.
     *
     * @param null|string $latitude
     *
     * @return Location
     */
    public function setLatitude($latitude = null) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return null|string
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set longitude.
     *
     * @param null|string $longitude
     *
     * @return Location
     */
    public function setLongitude($longitude = null) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return null|string
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Add artefactsRecovered.
     *
     * @param \AppBundle\Entity\Artefact $artefactsRecovered
     *
     * @return Location
     */
    public function addArtefactsRecovered(Artefact $artefactsRecovered) {
        $this->artefactsRecovered[] = $artefactsRecovered;

        return $this;
    }

    /**
     * Remove artefactsRecovered.
     *
     * @param \AppBundle\Entity\Artefact $artefactsRecovered
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArtefactsRecovered(Artefact $artefactsRecovered) {
        return $this->artefactsRecovered->removeElement($artefactsRecovered);
    }

    /**
     * Get artefactsRecovered.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtefactsRecovered() {
        return $this->artefactsRecovered;
    }

    /**
     * Add artefactsManufactured.
     *
     * @param \AppBundle\Entity\Artefact $artefactsManufactured
     *
     * @return Location
     */
    public function addArtefactsManufactured(Artefact $artefactsManufactured) {
        $this->artefactsManufactured[] = $artefactsManufactured;

        return $this;
    }

    /**
     * Remove artefactsManufactured.
     *
     * @param \AppBundle\Entity\Artefact $artefactsManufactured
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArtefactsManufactured(Artefact $artefactsManufactured) {
        return $this->artefactsManufactured->removeElement($artefactsManufactured);
    }

    /**
     * Get artefactsManufactured.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtefactsManufactured() {
        return $this->artefactsManufactured;
    }
}
