<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Artefact.
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
    const BOTTLE = 'bottle';

    const CAN = 'can';

    const CERAMIC = 'ceramic';

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsRecovered")
     */
    private $recoveryLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CircaDate", cascade={"persist", "remove"})
     */
    private $recoveryDate;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsManufactured")
     */
    private $manufactureLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CircaDate", cascade={"persist", "remove"})
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
     * @param null|string $catalogNumber
     *
     * @return Artefact
     */
    public function setCatalogNumber($catalogNumber = null) {
        $this->catalogNumber = $catalogNumber;

        return $this;
    }

    /**
     * Get catalogNumber.
     *
     * @return null|string
     */
    public function getCatalogNumber() {
        return $this->catalogNumber;
    }

    /**
     * Set description.
     *
     * @param null|string $description
     *
     * @return Artefact
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
     * Set furtherReading.
     *
     * @param null|string $furtherReading
     *
     * @return Artefact
     */
    public function setFurtherReading($furtherReading = null) {
        $this->furtherReading = $furtherReading;

        return $this;
    }

    /**
     * Get furtherReading.
     *
     * @return null|string
     */
    public function getFurtherReading() {
        return $this->furtherReading;
    }

    /**
     * Set note.
     *
     * @param null|string $note
     *
     * @return Artefact
     */
    public function setNote($note = null) {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return null|string
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * Set recoveryLocation.
     *
     * @param null|\AppBundle\Entity\Location $recoveryLocation
     *
     * @return Artefact
     */
    public function setRecoveryLocation(Location $recoveryLocation = null) {
        $this->recoveryLocation = $recoveryLocation;

        return $this;
    }

    /**
     * Get recoveryLocation.
     *
     * @return null|\AppBundle\Entity\Location
     */
    public function getRecoveryLocation() {
        return $this->recoveryLocation;
    }

    /**
     * Set recoveryDate.
     *
     * @param null|CircaDate|string $recoveryDate
     *
     * @throws Exception
     *
     * @return Artefact
     */
    public function setRecoveryDate($recoveryDate = null) {
        $this->recoveryDate = CircaDate::build($recoveryDate);

        return $this;
    }

    /**
     * Get recoveryDate.
     *
     * @return null|\AppBundle\Entity\CircaDate
     */
    public function getRecoveryDate() {
        return $this->recoveryDate;
    }

    /**
     * Set manufactureLocation.
     *
     * @param null|\AppBundle\Entity\Location $manufactureLocation
     *
     * @return Artefact
     */
    public function setManufactureLocation(Location $manufactureLocation = null) {
        $this->manufactureLocation = $manufactureLocation;

        return $this;
    }

    /**
     * Get manufactureLocation.
     *
     * @return null|\AppBundle\Entity\Location
     */
    public function getManufactureLocation() {
        return $this->manufactureLocation;
    }

    /**
     * Set manufactureDate.
     *
     * @param null|\AppBundle\Entity\CircaDate $manufactureDate
     *
     * @throws Exception
     *
     * @return Artefact
     */
    public function setManufactureDate($manufactureDate = null) {
        $this->manufactureDate = CircaDate::build($manufactureDate);

        return $this;
    }

    /**
     * Get manufactureDate.
     *
     * @return null|\AppBundle\Entity\CircaDate
     */
    public function getManufactureDate() {
        return $this->manufactureDate;
    }

    /**
     * Set institution.
     *
     * @param null|\AppBundle\Entity\Institution $institution
     *
     * @return Artefact
     */
    public function setInstitution(Institution $institution = null) {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution.
     *
     * @return null|\AppBundle\Entity\Institution
     */
    public function getInstitution() {
        return $this->institution;
    }

    /**
     * Add reference.
     *
     * @param \AppBundle\Entity\Reference $reference
     *
     * @return Artefact
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
