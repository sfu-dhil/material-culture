<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Can
 *
 * @ORM\Table(name="artefact_can")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CanRepository")
 */
class Can extends Artefact {

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
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $manufacturer;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $label;

    /**
     * @var Content
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Content", inversedBy="cans")
     */
    private $content;

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }

    public function getCategory() {
        return self::CAN;
    }
}
