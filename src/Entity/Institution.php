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
use Nines\UtilBundle\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Institution.
 *
 * @ORM\Table(name="institution", indexes={
 *     @ORM\Index(columns={"name", "url"}, flags={"fulltext"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\InstitutionRepository")
 */
class Institution extends AbstractEntity {
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url(
     *     protocols={"http", "https"}
     * )
     */
    private $url;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @var Artefact[]|Collection
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="institution")
     */
    private $artefacts;

    public function __construct() {
        parent::__construct();
        $this->artefacts = new ArrayCollection();
    }

    /**
     * Force all entities to provide a stringify function.
     */
    public function __toString() : string {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Institution
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set url.
     *
     * @param null|string $url
     *
     * @return Institution
     */
    public function setUrl($url = null) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return null|string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set address.
     *
     * @param null|string $address
     *
     * @return Institution
     */
    public function setAddress($address = null) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return null|string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set contact.
     *
     * @param null|string $contact
     *
     * @return Institution
     */
    public function setContact($contact = null) {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return null|string
     */
    public function getContact() {
        return $this->contact;
    }

    /**
     * Add artefact.
     *
     * @param \App\Entity\Artefact $artefact
     *
     * @return Institution
     */
    public function addArtefact(Artefact $artefact) {
        $this->artefacts[] = $artefact;

        return $this;
    }

    /**
     * Remove artefact.
     *
     * @param \App\Entity\Artefact $artefact
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArtefact(Artefact $artefact) {
        return $this->artefacts->removeElement($artefact);
    }

    /**
     * Get artefacts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtefacts() {
        return $this->artefacts;
    }
}
