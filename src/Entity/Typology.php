<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Typology.
 *
 * @ORM\Table(name="typology")
 * @ORM\Entity(repositoryClass="App\Repository\TypologyRepository")
 */
class Typology extends AbstractTerm {
    /**
     * @var ArrayCollection|Ceramic[]
     * @ORM\OneToMany(targetEntity="App\Entity\Ceramic", mappedBy="typology")
     */
    private $ceramics;

    public function __construct() {
        parent::__construct();
        $this->ceramics = new ArrayCollection();
    }

    /**
     * Add ceramic.
     *
     * @param \App\Entity\Ceramic $ceramic
     *
     * @return Typology
     */
    public function addCeramic(Ceramic $ceramic) {
        $this->ceramics[] = $ceramic;

        return $this;
    }

    /**
     * Remove ceramic.
     *
     * @param \App\Entity\Ceramic $ceramic
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCeramic(Ceramic $ceramic) {
        return $this->ceramics->removeElement($ceramic);
    }

    /**
     * Get ceramics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCeramics() {
        return $this->ceramics;
    }
}
