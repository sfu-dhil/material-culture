<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="category", type="string")
 * @ORM\DiscriminatorMap({
 *   "photo" = "Photograph",
 *   "drawing" = "Drawing",
 *   "scan3d" = "Scan3d"
 * })
 */
abstract class Image extends AbstractEntity {

    const PHOTO = "photo";

    const DRAWING = "drawing";

    const SCAN3D = "Scan3d";

    private $file;

    public function __construct() {
        parent::__construct();
    }

    abstract public function getCategory();

}
