<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image.
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image extends ImageEntity {
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
     * @param null|\AppBundle\Entity\Artefact $artefact
     *
     * @return Image
     */
    public function setArtefact(Artefact $artefact = null) {
        $this->artefact = $artefact;

        return $this;
    }

    /**
     * Get artefact.
     *
     * @return null|\AppBundle\Entity\Artefact
     */
    public function getArtefact() {
        return $this->artefact;
    }
}
