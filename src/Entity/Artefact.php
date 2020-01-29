<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Artefact.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArtefactRepository")
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
    public const BOTTLE = 'bottle';

    public const CAN = 'can';

    public const CERAMIC = 'ceramic';

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="artefactsRecovered")
     */
    private $recoveryLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="App\Entity\CircaDate", cascade={"persist", "remove"})
     */
    private $recoveryDate;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="artefactsManufactured")
     */
    private $manufactureLocation;

    /**
     * @var CircaDate
     * @ORM\ManyToOne(targetEntity="App\Entity\CircaDate", cascade={"persist", "remove"})
     */
    private $manufactureDate;

    /**
     * @var Institution
     * @ORM\ManyToOne(targetEntity="App\Entity\Institution", inversedBy="artefacts")
     */
    private $institution;

    /**
     * @var string
     * @ORM\Column(type="array", nullable=false)
     */
    private $catalogNumbers;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Reference", mappedBy="artefact", cascade={"persist"})
     */
    private $references;

    /**
     * @var Collection|Image[]
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="artefact")
     */
    private $images;

    public function __construct() {
        parent::__construct();
        $this->catalogNumbers = [];
        $this->references = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    abstract public function getCategory();

    /**
     * Set catalogNumber.
     *
     * @param array $catalogNumbers
     *
     * @return Artefact
     */
    public function setCatalogNumbers($catalogNumbers) {
        $this->catalogNumbers = array_unique($catalogNumbers);
        sort($this->catalogNumbers);

        return $this;
    }

    /**
     * Add a catalog number.
     *
     * @param $catalogNumber
     *
     * @return $this
     */
    public function addCatalogNumber($catalogNumber) {
        if ( ! in_array($catalogNumber, $this->catalogNumbers, true)) {
            $this->catalogNumbers[] = $catalogNumber;
            sort($this->catalogNumbers);
        }

        return $this;
    }

    /**
     * Remove a catalog number.
     *
     * @param $catalogNumber
     *
     * @return $this
     */
    public function removeCatalogNumber($catalogNumber) {
        if (($key = array_search($catalogNumber, $this->catalogNumbers, true))) {
            array_splice($this->catalogNumbers, $key, 1);
        }

        return $this;
    }

    /**
     * Get catalogNumber.
     *
     * @param mixed $sort
     *
     * @return array
     */
    public function getCatalogNumbers() {
        return $this->catalogNumbers;
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
     * @param null|\App\Entity\Location $recoveryLocation
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
     * @return null|\App\Entity\Location
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
     * @return null|\App\Entity\CircaDate
     */
    public function getRecoveryDate() {
        return $this->recoveryDate;
    }

    /**
     * Set manufactureLocation.
     *
     * @param null|\App\Entity\Location $manufactureLocation
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
     * @return null|\App\Entity\Location
     */
    public function getManufactureLocation() {
        return $this->manufactureLocation;
    }

    /**
     * Set manufactureDate.
     *
     * @param null|\App\Entity\CircaDate $manufactureDate
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
     * @return null|\App\Entity\CircaDate
     */
    public function getManufactureDate() {
        return $this->manufactureDate;
    }

    /**
     * Set institution.
     *
     * @param null|\App\Entity\Institution $institution
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
     * @return null|\App\Entity\Institution
     */
    public function getInstitution() {
        return $this->institution;
    }

    /**
     * Add reference.
     *
     * @param \App\Entity\Reference $reference
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
     * @param \App\Entity\Reference $reference
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

    /**
     * Check if the artefact record contains an image.
     *
     * @return bool true if the collection of images contains the image.
     */
    public function hasImage(Image $image) {
        return $this->images->contains($image);
    }

    /**
     * Add image.
     *
     * @param \App\Entity\Image $image
     *
     * @return Artefact
     */
    public function addImage(Image $image) {
        if ( ! $this->hasImage($image)) {
            $this->images[] = $image;
        }

        return $this;
    }

    /**
     * Remove image.
     *
     * @param \App\Entity\Image $image
     *
     * @return bool true if this collection contained the specified element, FALSE otherwise.
     */
    public function removeImage(Image $image) {
        return $this->images->removeElement($image);
    }

    /**
     * Get images.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages() {
        return $this->images;
    }
}
