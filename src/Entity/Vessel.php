<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Form.
 *
 * @ORM\Table(name="vessel")
 * @ORM\Entity(repositoryClass="App\Repository\VesselRepository")
 */
class Vessel extends AbstractTerm {
    /**
     * @var Ceramic[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Ceramic", mappedBy="vessel")
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
     * @return Vessel
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
