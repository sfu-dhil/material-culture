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
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
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

}
