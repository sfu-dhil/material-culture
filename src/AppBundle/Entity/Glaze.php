<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Glaze
 *
 * @ORM\Table(name="glaze")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GlazeRepository")
 */
class Glaze extends AbstractTerm {

    /**
     * @var Collection|Ceramic[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ceramic", mappedBy="glaze")
     */
    private $ceramics;

}
