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
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Manufacturer.
 *
 * @ORM\Table(name="manufacturer")
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerRepository")
 */
class Manufacturer extends AbstractTerm
{
    /**
     * @var Bottle[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Bottle", mappedBy="manufacturer")
     */
    private $bottles;

    /**
     * @var Can[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Can", mappedBy="manufacturer")
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
     * @param \App\Entity\Bottle $bottle
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
     * @param \App\Entity\Bottle $bottle
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
     * @param \App\Entity\Can $can
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
     * @param \App\Entity\Can $can
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
