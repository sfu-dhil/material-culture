<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Manufacturer
 *
 * @ORM\Table(name="manufacturer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManufacturerRepository")
 */
class Manufacturer extends AbstractTerm {

    /**
     * @var Collection|Bottle[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bottle", mappedBy="manufacturer")
     */
    private $bottles;

    /**
     * @var Collection|Can[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Can", mappedBy="manufacturer")
     */
    private $cans;


    /**
     * Add bottle.
     *
     * @param \AppBundle\Entity\Bottle $bottle
     *
     * @return Manufacturer
     */
    public function addBottle(\AppBundle\Entity\Bottle $bottle)
    {
        $this->bottles[] = $bottle;

        return $this;
    }

    /**
     * Remove bottle.
     *
     * @param \AppBundle\Entity\Bottle $bottle
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBottle(\AppBundle\Entity\Bottle $bottle)
    {
        return $this->bottles->removeElement($bottle);
    }

    /**
     * Get bottles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBottles()
    {
        return $this->bottles;
    }

    /**
     * Add can.
     *
     * @param \AppBundle\Entity\Can $can
     *
     * @return Manufacturer
     */
    public function addCan(\AppBundle\Entity\Can $can)
    {
        $this->cans[] = $can;

        return $this;
    }

    /**
     * Remove can.
     *
     * @param \AppBundle\Entity\Can $can
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCan(\AppBundle\Entity\Can $can)
    {
        return $this->cans->removeElement($can);
    }

    /**
     * Get cans.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCans()
    {
        return $this->cans;
    }
}
