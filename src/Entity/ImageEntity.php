<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
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
 * @ORM\MappedSuperclass()
 */
abstract class ImageEntity extends AbstractEntity {
    /**
     * @var string
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $originalName;

    /**
     * @var File
     */
    private $imageFile;

    /**
     * @var File
     */
    private $thumbnailFile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=48, nullable=false)
     */
    private $imageFilePath;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=48, nullable=false)
     */
    private $thumbnailPath;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $imageSize;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageWidth;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageHeight;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getOriginalName() : ?string {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName) : ImageEntity {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile() : ?File {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile) : ImageEntity {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return File
     */
    public function getThumbnailFile() : ?File {
        return $this->thumbnailFile;
    }

    public function setThumbnailFile(File $thumbnailFile) : ImageEntity {
        $this->thumbnailFile = $thumbnailFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFilePath() : ?string {
        return $this->imageFilePath;
    }

    public function setImageFilePath(string $imageFilePath) : ImageEntity {
        $this->imageFilePath = $imageFilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailPath() : ?string {
        return $this->thumbnailPath;
    }

    public function setThumbnailPath(string $thumbnailPath) : ImageEntity {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageSize() : ?int {
        return $this->imageSize;
    }

    public function setImageSize(int $imageSize) : ImageEntity {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageWidth() : ?int {
        return $this->imageWidth;
    }

    public function setImageWidth(int $imageWidth) : ImageEntity {
        $this->imageWidth = $imageWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getImageHeight() : ?int {
        return $this->imageHeight;
    }

    public function setImageHeight(int $imageHeight) : ImageEntity {
        $this->imageHeight = $imageHeight;

        return $this;
    }
}
