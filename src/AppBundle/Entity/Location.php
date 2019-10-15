<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location extends AbstractTerm {

    /**
     * @var string
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $geonameId;

    /**
     * @var double
     * @ORM\Column(type="double", nullable=true)
     */
    private $latitude;

    /**
     * @var double
     * @ORM\Column(type="double", nullable=true)
     */
    private $longitude;

}
