<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bottle
 *
 * @ORM\Table(name="bottle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BottleRepository")
 */
class Bottle extends Artefact
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
        return self::BOTTLE;
    }
}
