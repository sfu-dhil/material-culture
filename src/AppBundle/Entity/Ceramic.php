<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ceramic.
 *
 * @ORM\Table(name="artefact_ceramic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CeramicRepository")
 */
class Ceramic extends Artefact {
    /**
     * @var Shape
     * @ORM\ManyToOne(targetEntity="Shape", inversedBy="ceramics")
     */
    private $shape;

    /**
     * @var Glaze
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Glaze", inversedBy="ceramics")
     */
    private $glaze;

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

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return $this->getCatalogNumber() . ' ' . $this->shape;
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
     * Set shape.
     *
     * @param null|\AppBundle\Entity\Shape $shape
     *
     * @return Ceramic
     */
    public function setShape(Shape $shape = null) {
        $this->shape = $shape;

        return $this;
    }

    /**
     * Get shape.
     *
     * @return null|\AppBundle\Entity\Shape
     */
    public function getShape() {
        return $this->shape;
    }

    /**
     * Set glaze.
     *
     * @param null|\AppBundle\Entity\Glaze $glaze
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
     * @return null|\AppBundle\Entity\Glaze
     */
    public function getGlaze() {
        return $this->glaze;
    }
}
