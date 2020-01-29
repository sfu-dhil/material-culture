<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image.
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image extends ImageEntity {
    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default": false})
     */
    private $public;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $copyright;

    /**
     * @var Artefact
     * @ORM\ManyToOne(targetEntity="Artefact", inversedBy="images")
     */
    private $artefact;

    public function __construct() {
        parent::__construct();
        $this->public = false;
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
     * @param null|\App\Entity\Artefact $artefact
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
     * @return null|\App\Entity\Artefact
     */
    public function getArtefact() {
        return $this->artefact;
    }

    /**
     * Set public.
     *
     * @param bool $public
     *
     * @return Image
     */
    public function setPublic($public) {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public.
     *
     * @return bool
     */
    public function getPublic() {
        return $this->public;
    }

    /**
     * Set copyright.
     *
     * @param null|string $copyright
     *
     * @return Image
     */
    public function setCopyright($copyright = null) {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright.
     *
     * @return null|string
     */
    public function getCopyright() {
        return $this->copyright;
    }
}
