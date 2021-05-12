<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nines\UtilBundle\Entity\AbstractEntity;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ImageEntity.
 *
 * @ORM\MappedSuperclass
 */
abstract class ImageEntity extends AbstractEntity {
    /**
     * @var File
     */
    private $imageFile;

    /**
     * @var File
     */
    private $thumbFile;

    /**
     * @var string
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $originalName;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $imagePath;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $thumbPath;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $imageSize;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $imageWidth;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $imageHeight;

    public function __construct() {
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString() : string {
        return $this->imageFile->getFilename();
    }

    /**
     * @return string
     */
    public function getOriginalName() : ?string {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName) : self {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile() : ?File {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile) : self {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return File
     */
    public function getThumbFile() : ?File {
        return $this->thumbFile;
    }

    public function setThumbFile(File $thumbFile) : self {
        $this->thumbFile = $thumbFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getImagePath() : ?string {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath) : self {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbPath() : ?string {
        return $this->thumbPath;
    }

    public function setThumbPath(string $thumbPath) : self {
        $this->thumbPath = $thumbPath;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageSize() : ?int {
        return $this->imageSize;
    }

    public function setImageSize(int $imageSize) : self {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageWidth() : ?int {
        return $this->imageWidth;
    }

    public function setImageWidth(int $imageWidth) : self {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageHeight() : ?int {
        return $this->imageHeight;
    }

    public function setImageHeight(int $imageHeight) : self {
        $this->imageHeight = $imageHeight;

        return $this;
    }
}
