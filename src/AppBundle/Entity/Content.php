<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Content.
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 */
class Content extends AbstractTerm {
    /**
     * @var Bottle[]|Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bottle", mappedBy="content")
     */
    private $bottles;

    /**
     * @var Can[]|Collection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Can", mappedBy="content")
     */
    private $cans;

    public function __construct() {
        parent::__construct();
        $this->bottles = new ArrayCollection();
        $this->cans = new ArrayCollection();
    }

    /**
     * Add bottle.
     *
     * @param \AppBundle\Entity\Bottle $bottle
     *
     * @return Content
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
     * @return Content
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
