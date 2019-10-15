<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Nines\UtilBundle\Entity\AbstractTerm;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 */
class Content extends AbstractTerm {

    /**
     * @var Collection|Bottle[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bottle", mappedBy="content")
     */
    private $bottles;

    /**
     * @var Collection|Can[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Can", mappedBy="content")
     */
    private $cans;

}
