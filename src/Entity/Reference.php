<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Reference.
 *
 * @ORM\Table(name="reference")
 * @ORM\Entity(repositoryClass="App\Repository\ReferenceRepository")
 */
class Reference extends AbstractEntity {
    /**
     * @var Publication
     * @ORM\ManyToOne(targetEntity="App\Entity\Publication", inversedBy="references")
     */
    private $publication;

    /**
     * @var Artefact
     * @ORM\ManyToOne(targetEntity="App\Entity\Artefact", inversedBy="references")
     */
    private $artefact;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * Force all entities to provide a stringify function.
     */
    public function __toString() : string {
        return $this->publication . ' ' . $this->artefact;
    }

    /**
     * Set description.
     *
     * @param null|string $description
     *
     * @return Reference
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
     * Set publication.
     *
     * @param null|\App\Entity\Publication $publication
     *
     * @return Reference
     */
    public function setPublication(?Publication $publication = null) {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication.
     *
     * @return null|\App\Entity\Publication
     */
    public function getPublication() {
        return $this->publication;
    }

    /**
     * Set artefact.
     *
     * @param null|\App\Entity\Artefact $artefact
     *
     * @return Reference
     */
    public function setArtefact(?Artefact $artefact = null) {
        $this->artefact = $artefact;

        return $this;
    }

    /**
     * Get artefact.
     *
     * @return null|\App\Entity\Artefact
     */
    public function getArtefact() {
        return $this->artefact;
    }
}
