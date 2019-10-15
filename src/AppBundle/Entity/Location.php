<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

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
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $latitude;

    /**
     * @var double
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $longitude;

    /**
     * @var Collection|Artefact[]
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="recoveryLocation")
     */
    private $artefactsRecovered;

    /**
     * @var Collection|Artefact[]
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="manufactureLocation")
     */
    private $artefactsManufactured;
}
