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

    private $recoveryLocation;

    private $recoveryDate;

    private $manufactureLocation;

    private $manufactureDate;

    private $institution;

    private $catalogNumber;

    /**
     * public notes
     */
    private $description;

    private $furtherReading;

    /**
     * private notes
     */
    private $note;

    private $references;

    public function __construct() {
        parent::__construct();
    }

    abstract public function getCategory();
}
