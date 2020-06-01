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
 * Ceramic.
 *
 * @ORM\Table(name="artefact_ceramic")
 * @ORM\Entity(repositoryClass="App\Repository\CeramicRepository")
 */
class Ceramic extends Artefact {
    /**
     * @var Vessel
     * @ORM\ManyToOne(targetEntity="Vessel", inversedBy="ceramics")
     */
    private $vessel;

    /**
     * @var Glaze
     * @ORM\ManyToOne(targetEntity="App\Entity\Glaze", inversedBy="ceramics")
     */
    private $glaze;

    /**
     * @var Typology
     * @ORM\ManyToOne(targetEntity="App\Entity\Typology", inversedBy="ceramics")
     */
    private $typology;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $paste;

    /**
     * see https://en.wikipedia.org/wiki/Munsell_color_system.
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $munsell;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() : string {
        return 'Ceramic #' . $this->getId();
    }

    public function getCategory() {
        return self::CERAMIC;
    }

    /**
     * Set paste.
     *
     * @param null|string $paste
     *
     * @return Ceramic
     */
    public function setPaste($paste = null) {
        $this->paste = $paste;

        return $this;
    }

    /**
     * Get paste.
     *
     * @return null|string
     */
    public function getPaste() {
        return $this->paste;
    }

    /**
     * Set munsell.
     *
     * @param null|string $munsell
     *
     * @return Ceramic
     */
    public function setMunsell($munsell = null) {
        $this->munsell = $munsell;

        return $this;
    }

    /**
     * Get munsell.
     *
     * @return null|string
     */
    public function getMunsell() {
        return $this->munsell;
    }

    /**
     * Set vessel.
     *
     * @param null|\App\Entity\Vessel $vessel
     *
     * @return Ceramic
     */
    public function setVessel(Vessel $vessel = null) {
        $this->vessel = $vessel;

        return $this;
    }

    /**
     * Get vessel.
     *
     * @return null|\App\Entity\Vessel
     */
    public function getVessel() {
        return $this->vessel;
    }

    /**
     * Set glaze.
     *
     * @param null|\App\Entity\Glaze $glaze
     *
     * @return Ceramic
     */
    public function setGlaze(Glaze $glaze = null) {
        $this->glaze = $glaze;

        return $this;
    }

    /**
     * Get glaze.
     *
     * @return null|\App\Entity\Glaze
     */
    public function getGlaze() {
        return $this->glaze;
    }

    /**
     * Set typology.
     *
     * @param null|\App\Entity\Typology $typology
     *
     * @return Ceramic
     */
    public function setTypology(Typology $typology = null) {
        $this->typology = $typology;

        return $this;
    }

    /**
     * Get typology.
     *
     * @return null|\App\Entity\Typology
     */
    public function getTypology() {
        return $this->typology;
    }
}
