<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Form
 *
 * @ORM\Table(name="form")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShapeRepository")
 */
class Shape extends AbstractTerm {

    /**
     * @var Collection|Ceramic[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ceramic", mappedBy="shape")
     */
    private $ceramics;

}
