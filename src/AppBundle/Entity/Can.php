<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Can
 *
 * @ORM\Table(name="can")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CanRepository")
 */
class Can extends Artefact
{
    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }

    public function getCategory() {
        return self::CAN;
    }
}
