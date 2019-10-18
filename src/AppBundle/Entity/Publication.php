<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Publication.
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationRepository")
 */
class Publication extends AbstractEntity {
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $citation;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $doi;

    /**
     * @var Collection|Reference[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reference", mappedBy="publication")
     */
    private $references;

    public function __construct() {
        parent::__construct();
        $this->references = new ArrayCollection();
    }

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Publication
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set citation.
     *
     * @param string $citation
     *
     * @return Publication
     */
    public function setCitation($citation) {
        $this->citation = $citation;

        return $this;
    }

    /**
     * Get citation.
     *
     * @return string
     */
    public function getCitation() {
        return $this->citation;
    }

    /**
     * Set doi.
     *
     * @param null|string $doi
     *
     * @return Publication
     */
    public function setDoi($doi = null) {
        $this->doi = $doi;

        return $this;
    }

    /**
     * Get doi.
     *
     * @return null|string
     */
    public function getDoi() {
        return $this->doi;
    }

    /**
     * Add reference.
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return Publication
     */
    public function addReference(Reference $reference) {
        $this->references[] = $reference;

        return $this;
    }

    /**
     * Remove reference.
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReference(Reference $reference) {
        return $this->references->removeElement($reference);
    }

    /**
     * Get references.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferences() {
        return $this->references;
    }
}
