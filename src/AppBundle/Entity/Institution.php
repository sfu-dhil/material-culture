<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Institution
 *
 * @ORM\Table(name="institution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstitutionRepository")
 */
class Institution extends AbstractEntity {

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url(
     *     checkDNS = "ANY",
     *     dnsMessage = "The domain name '{{ value }}' does not exist.",
     *     protocols = {"http", "https"}
     * )
     */
    private $url;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @var Collection|Artefact[]
     * @ORM\OneToMany(targetEntity="Artefact", mappedBy="institution")
     */
    private $artefacts;

    /**
     * Force all entities to provide a stringify function.
     *
     * @return string
     */
    public function __toString() {
        return $this->name;
    }
}
