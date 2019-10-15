<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Reference
 *
 * @ORM\Table(name="reference")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReferenceRepository")
 */
class Reference extends AbstractEntity {

    /**
     * @var Publication
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication", inversedBy="references")
     */
    private $publication;

    /**
     * @var Artefact
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Artefact", inversedBy="references")
     */
    private $artefact;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }
}
