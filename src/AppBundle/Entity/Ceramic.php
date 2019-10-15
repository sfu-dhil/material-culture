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
}
