<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Image
 *
 * @ORM\Table(name="scan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScanRepository")
 */
class Scan extends AbstractEntity {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }
}
