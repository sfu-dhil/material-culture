<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Institution
 *
 * @ORM\Table(name="institution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRepository")
 */
class Institution extends AbstractEntity
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
