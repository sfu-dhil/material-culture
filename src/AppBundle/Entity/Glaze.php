<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Glaze
 *
 * @ORM\Table(name="glaze")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GlazeRepository")
 */
class Glaze extends AbstractEntity
{

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }
}
