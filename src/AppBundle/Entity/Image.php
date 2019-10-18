<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Image.
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image extends AbstractEntity {
    use ImageTrait;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Artefact
     * @ORM\ManyToOne(targetEntity="Artefact", inversedBy="images")
     */
    private $artefact;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return $this->getOriginalName();
    }

    /**
     * Set description.
     *
     * @param null|string $description
     *
     * @return Image
     */
    public function setDescription($description = null) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return null|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set artefact.
     *
     * @param \AppBundle\Entity\Artefact|null $artefact
     *
     * @return Image
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
