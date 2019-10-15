<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bottle
 *
 * @ORM\Table(name="artefact_bottle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BottleRepository")
 */
class Bottle extends Artefact {

    private $company;

    private $brand;

    private $manufacturer;

    private $content;

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
