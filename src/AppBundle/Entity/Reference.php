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

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Reference
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set publication.
     *
     * @param \AppBundle\Entity\Publication|null $publication
     *
     * @return Reference
     */
    public function setPublication(\AppBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication.
     *
     * @return \AppBundle\Entity\Publication|null
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set artefact.
     *
     * @param \AppBundle\Entity\Artefact|null $artefact
     *
     * @return Reference
     */
    public function setArtefact(\AppBundle\Entity\Artefact $artefact = null)
    {
        $this->artefact = $artefact;

        return $this;
    }

    /**
     * Get artefact.
     *
     * @return \AppBundle\Entity\Artefact|null
     */
    public function getArtefact()
    {
        return $this->artefact;
    }
}
