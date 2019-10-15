<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Glaze
 *
 * @ORM\Table(name="glaze")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GlazeRepository")
 */
class Glaze extends AbstractTerm {

    /**
     * @var Collection|Ceramic[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ceramic", mappedBy="glaze")
     */
    private $ceramics;


    /**
     * Add ceramic.
     *
     * @param \AppBundle\Entity\Ceramic $ceramic
     *
     * @return Glaze
     */
    public function addCeramic(\AppBundle\Entity\Ceramic $ceramic)
    {
        $this->ceramics[] = $ceramic;

        return $this;
    }

    /**
     * Remove ceramic.
     *
     * @param \AppBundle\Entity\Ceramic $ceramic
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCeramic(\AppBundle\Entity\Ceramic $ceramic)
    {
        return $this->ceramics->removeElement($ceramic);
    }

    /**
     * Get ceramics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCeramics()
    {
        return $this->ceramics;
    }
}
