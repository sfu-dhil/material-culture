<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Glaze.
 *
 * @ORM\Table(name="glaze")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GlazeRepository")
 */
class Glaze extends AbstractTerm {
    /**
     * @var Ceramic[]|Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ceramic", mappedBy="glaze")
     */
    private $ceramics;

    public function __construct() {
        parent::__construct();
        $this->ceramics = new ArrayCollection();
    }

    /**
     * Add ceramic.
     *
     * @param \AppBundle\Entity\Ceramic $ceramic
     *
     * @return Glaze
     */
    public function addCeramic(Ceramic $ceramic) {
        $this->ceramics[] = $ceramic;

        return $this;
    }

    /**
     * Remove ceramic.
     *
     * @param \AppBundle\Entity\Ceramic $ceramic
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
