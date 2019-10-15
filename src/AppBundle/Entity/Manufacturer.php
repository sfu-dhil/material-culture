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

}
