<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Artefact
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtefactRepository")
 * @ORM\Table(name="artefact")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="category", type="string")
 * @ORM\DiscriminatorMap({
 *   "bottle" = "Bottle",
 *   "can" = "Can",
 *   "ceramic" = "Ceramic"
 * })
 */
abstract class Artefact extends AbstractEntity {

    const BOTTLE = "bottle";

    const CAN = "can";

    const CERAMIC = "ceramic";

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsRecovered")
     */
    private $recoveryLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CircaDate")
     */
    private $recoveryDate;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsManufactured")
     */
    private $manufactureLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CircaDate")
     */
    private $manufactureDate;

    /**
     * @var Institution
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Institution", inversedBy="artefacts")
     */
    private $institution;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $catalogNumber;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $furtherReading;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @var Collection|Reference[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reference", mappedBy="artefact")
     */
    private $references;

    public function __construct() {
        parent::__construct();
    }

    abstract public function getCategory();

    /**
     * Set catalogNumber.
     *
     * @param string|null $catalogNumber
     *
     * @return Artefact
     */
    public function setCatalogNumber($catalogNumber = null)
    {
        $this->catalogNumber = $catalogNumber;

        return $this;
    }

    /**
     * Get catalogNumber.
     *
     * @return string|null
     */
    public function getCatalogNumber()
    {
        return $this->catalogNumber;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Artefact
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
     * Set furtherReading.
     *
     * @param string|null $furtherReading
     *
     * @return Artefact
     */
    public function setFurtherReading($furtherReading = null)
    {
        $this->furtherReading = $furtherReading;

        return $this;
    }

    /**
     * Get furtherReading.
     *
     * @return string|null
     */
    public function getFurtherReading()
    {
        return $this->furtherReading;
    }

    /**
     * Set note.
     *
     * @param string|null $note
     *
     * @return Artefact
     */
    public function setNote($note = null)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string|null
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set recoveryLocation.
     *
     * @param \AppBundle\Entity\Location|null $recoveryLocation
     *
     * @return Artefact
     */
    public function setRecoveryLocation(\AppBundle\Entity\Location $recoveryLocation = null)
    {
        $this->recoveryLocation = $recoveryLocation;

        return $this;
    }

    /**
     * Get recoveryLocation.
     *
     * @return \AppBundle\Entity\Location|null
     */
    public function getRecoveryLocation()
    {
        return $this->recoveryLocation;
    }

    /**
     * Set recoveryDate.
     *
     * @param \AppBundle\Entity\CircaDate|null $recoveryDate
     *
     * @return Artefact
     */
    public function setRecoveryDate(\AppBundle\Entity\CircaDate $recoveryDate = null)
    {
        $this->recoveryDate = $recoveryDate;

        return $this;
    }

    /**
     * Get recoveryDate.
     *
     * @return \AppBundle\Entity\CircaDate|null
     */
    public function getRecoveryDate()
    {
        return $this->recoveryDate;
    }

    /**
     * Set manufactureLocation.
     *
     * @param \AppBundle\Entity\Location|null $manufactureLocation
     *
     * @return Artefact
     */
    public function setManufactureLocation(\AppBundle\Entity\Location $manufactureLocation = null)
    {
        $this->manufactureLocation = $manufactureLocation;

        return $this;
    }

    /**
     * Get manufactureLocation.
     *
     * @return \AppBundle\Entity\Location|null
     */
    public function getManufactureLocation()
    {
        return $this->manufactureLocation;
    }

    /**
     * Set manufactureDate.
     *
     * @param \AppBundle\Entity\CircaDate|null $manufactureDate
     *
     * @return Artefact
     */
    public function setManufactureDate(\AppBundle\Entity\CircaDate $manufactureDate = null)
    {
        $this->manufactureDate = $manufactureDate;

        return $this;
    }

    /**
     * Get manufactureDate.
     *
     * @return \AppBundle\Entity\CircaDate|null
     */
    public function getManufactureDate()
    {
        return $this->manufactureDate;
    }

    /**
     * Set institution.
     *
     * @param \AppBundle\Entity\Institution|null $institution
     *
     * @return Artefact
     */
    public function setInstitution(\AppBundle\Entity\Institution $institution = null)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution.
     *
     * @return \AppBundle\Entity\Institution|null
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Add reference.
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return Artefact
     */
    public function addReference(\AppBundle\Entity\Reference $reference)
    {
        $this->references[] = $reference;

        return $this;
    }

    /**
     * Remove reference.
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReference(\AppBundle\Entity\Reference $reference)
    {
        return $this->references->removeElement($reference);
    }

    /**
     * Get references.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferences()
    {
        return $this->references;
    }
}
