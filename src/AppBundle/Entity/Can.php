<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Can
 *
 * @ORM\Table(name="artefact_can")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CanRepository")
 */
class Can extends Artefact {

    private $product;

    private $company;

    private $brand;

    private $manufacturer;

    private $label;

    private $productionLocation;

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
