<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Artefact
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtefactRepository")
 * @ORM\Table(name="artefact")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="category", type="string")
 * @ORM\DiscriminatorMap({
 *   "bottle" = "Bottle",
 *   "can" = "Can",
 *   "ceramic" = "Ceramic"
 * })
 */
abstract class Artefact extends AbstractEntity {

    const BOTTLE = "bottle";

    const CAN = "can";

    const CERAMIC = "ceramic";

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsRecovered")
     */
    private $recoveryLocation;

    private $recoveryDate;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="artefactsManufactured")
     */
    private $manufactureLocation;

    private $manufactureDate;

    /**
     * @var Institution
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Institution", inversedBy="artefacts")
     */
    private $institution;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $catalogNumber;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $furtherReading;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $references;

    public function __construct() {
        parent::__construct();
    }

    abstract public function getCategory();
}
