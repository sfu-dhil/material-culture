<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Location.
 *
 * See http://download.geonames.org/export/dump/readme.txt
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
     * @ORM\Column(type="decimal", precision=11, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=11, scale=8, nullable=true)
     */
    private $longitude;

    /**
     * Comma separated, ascii names, automatically transliterated.
     *
     * @var string
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $alternateNames;

    /**
     * ISO-3166 2-letter country code, 2 characters.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $countryCode;

    /**
     * Fipscode.
     *
     * @var string
     *
     * @ORM\Column(name="admin1", type="string", length=20, nullable=true)
     */
    private $admin1;

    /**
     * Code for the second administrative division, a county in the US.
     *
     * @var string
     *
     * @ORM\Column(name="admin2", type="string", length=80, nullable=true)
     */
    private $admin2;

    /**
     * Code for third level administrative division.
     *
     * @var string
     *
     * @ORM\Column(name="admin3", type="string", length=20, nullable=true)
     */
    private $admin3;

    /**
     * Code for fourth level administrative division.
     *
     * @var string
     *
     * @ORM\Column(name="admin4", type="string", length=20, nullable=true)
     */
    private $admin4;

    /**
     * The iana timezone id.
     *
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=40, nullable=true)
     */
    private $timezone;

    /**
     * @var int
     *
     * @ORM\Column(name="elevation", type="integer", nullable=true)
     */
    private $elevation;

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
     * Set alternateNames.
     *
     * @param null|array $alternateNames
     *
     * @return Location
     */
    public function setAlternateNames($alternateNames = null) {
        $this->alternateNames = $alternateNames;

        return $this;
    }

    /**
     * Get alternateNames.
     *
     * @return null|array
     */
    public function getAlternateNames() {
        return $this->alternateNames;
    }

    /**
     * Set countryCode.
     *
     * @param null|string $countryCode
     *
     * @return Location
     */
    public function setCountryCode($countryCode = null) {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode.
     *
     * @return null|string
     */
    public function getCountryCode() {
        return $this->countryCode;
    }

    /**
     * Set admin1.
     *
     * @param null|string $admin1
     *
     * @return Location
     */
    public function setAdmin1($admin1 = null) {
        $this->admin1 = $admin1;

        return $this;
    }

    /**
     * Get admin1.
     *
     * @return null|string
     */
    public function getAdmin1() {
        return $this->admin1;
    }

    /**
     * Set admin2.
     *
     * @param null|string $admin2
     *
     * @return Location
     */
    public function setAdmin2($admin2 = null) {
        $this->admin2 = $admin2;

        return $this;
    }

    /**
     * Get admin2.
     *
     * @return null|string
     */
    public function getAdmin2() {
        return $this->admin2;
    }

    /**
     * Set admin3.
     *
     * @param null|string $admin3
     *
     * @return Location
     */
    public function setAdmin3($admin3 = null) {
        $this->admin3 = $admin3;

        return $this;
    }

    /**
     * Get admin3.
     *
     * @return null|string
     */
    public function getAdmin3() {
        return $this->admin3;
    }

    /**
     * Set admin4.
     *
     * @param null|string $admin4
     *
     * @return Location
     */
    public function setAdmin4($admin4 = null) {
        $this->admin4 = $admin4;

        return $this;
    }

    /**
     * Get admin4.
     *
     * @return null|string
     */
    public function getAdmin4() {
        return $this->admin4;
    }

    /**
     * Set timezone.
     *
     * @param null|string $timezone
     *
     * @return Location
     */
    public function setTimezone($timezone = null) {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone.
     *
     * @return null|string
     */
    public function getTimezone() {
        return $this->timezone;
    }

    /**
     * Set elevation.
     *
     * @param null|int $elevation
     *
     * @return Location
     */
    public function setElevation($elevation = null) {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * Get elevation.
     *
     * @return null|int
     */
    public function getElevation() {
        return $this->elevation;
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
