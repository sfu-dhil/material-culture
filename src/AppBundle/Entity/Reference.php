<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Reference
 *
 * @ORM\Table(name="reference")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReferenceRepository")
 */
class Reference extends AbstractEntity {

    private $publication;

    private $artefact;

    private $description;

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        // TODO: Implement __toString() method.
    }
}
