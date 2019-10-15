<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ceramic
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
     * see https://en.wikipedia.org/wiki/Munsell_color_system
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
        // TODO: Implement __toString() method.
    }

    public function getCategory() {
        return self::CERAMIC;
    }

    /**
     * Set paste.
     *
     * @param string|null $paste
     *
     * @return Ceramic
     */
    public function setPaste($paste = null)
    {
        $this->paste = $paste;

        return $this;
    }

    /**
     * Get paste.
     *
     * @return string|null
     */
    public function getPaste()
    {
        return $this->paste;
    }

    /**
     * Set munsell.
     *
     * @param string|null $munsell
     *
     * @return Ceramic
     */
    public function setMunsell($munsell = null)
    {
        $this->munsell = $munsell;

        return $this;
    }

    /**
     * Get munsell.
     *
     * @return string|null
     */
    public function getMunsell()
    {
        return $this->munsell;
    }

    /**
     * Set shape.
     *
     * @param \AppBundle\Entity\Shape|null $shape
     *
     * @return Ceramic
     */
    public function setShape(\AppBundle\Entity\Shape $shape = null)
    {
        $this->shape = $shape;

        return $this;
    }

    /**
     * Get shape.
     *
     * @return \AppBundle\Entity\Shape|null
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * Set glaze.
     *
     * @param \AppBundle\Entity\Glaze|null $glaze
     *
     * @return Ceramic
     */
    public function setGlaze(\AppBundle\Entity\Glaze $glaze = null)
    {
        $this->glaze = $glaze;

        return $this;
    }

    /**
     * Get glaze.
     *
     * @return \AppBundle\Entity\Glaze|null
     */
    public function getGlaze()
    {
        return $this->glaze;
    }
}
