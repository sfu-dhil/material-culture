<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Manufacturer.
 *
 * @ORM\Table(name="manufacturer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ManufacturerRepository")
 */
class Manufacturer extends AbstractTerm {
    /**
     * @var Bottle[]|Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bottle", mappedBy="manufacturer")
     */
    private $bottles;

    /**
     * @var Can[]|Collection
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
    public function addBottle(Bottle $bottle) {
        $this->bottles[] = $bottle;

        return $this;
    }

    /**
     * Remove bottle.
     *
     * @param \AppBundle\Entity\Bottle $bottle
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBottle(Bottle $bottle) {
        return $this->bottles->removeElement($bottle);
    }

    /**
     * Get bottles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBottles() {
        return $this->bottles;
    }

    /**
     * Add can.
     *
     * @param \AppBundle\Entity\Can $can
     *
     * @return Manufacturer
     */
    public function addCan(Can $can) {
        $this->cans[] = $can;

        return $this;
    }

    /**
     * Remove can.
     *
     * @param \AppBundle\Entity\Can $can
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCan(Can $can) {
        return $this->cans->removeElement($can);
    }

    /**
     * Get cans.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCans() {
        return $this->cans;
    }
}
