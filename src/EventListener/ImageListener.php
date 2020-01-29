<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\EventListener;

use App\Entity\ImageEntity;
use App\Services\FileUploader;
use App\Services\Thumbnailer;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of ClippingListener.
 *
 * @author Michael Joyce <ubermichael@gmail.com>
 */
class ImageListener {
    /**
     * @var FileUploader
     */
    private $uploader;

    /**
     * @var Thumbnailer
     */
    private $thumbnailer;

    /**
     * @var int
     */
    private $thumbWidth;

    /**
     * @var int
     */
    private $thumbHeight;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(FileUploader $uploader, Thumbnailer $thumbnailer, LoggerInterface $logger) {
        $this->uploader = $uploader;
        $this->thumbnailer = $thumbnailer;
        $this->logger = $logger;
    }

    private function uploadFile(ImageEntity $image) : void {
        $file = $image->getImageFile();
        if ( ! $file instanceof UploadedFile) {
            return;
        }
        $filename = $this->uploader->upload($file);
        $image->setImageFilePath($filename);
        $image->setOriginalName($file->getClientOriginalName());
        $image->setImageSize($file->getClientSize());
        $dimensions = getimagesize($this->uploader->getImageDir() . '/' . $filename);
        $image->setImageWidth($dimensions[0]);
        $image->setImageHeight($dimensions[1]);

        $clippingFile = new File($this->uploader->getImageDir() . '/' . $filename);
        $image->setImageFile($clippingFile);
        $image->setThumbnailPath($this->thumbnailer->thumbnail($image));
    }

    public function setThumbWidth($width) : void {
        $this->thumbWidth = $width;
    }

    public function setThumbHeight($height) : void {
        $this->thumbHeight = $height;
    }

    public function prePersist(LifecycleEventArgs $args) : void {
        $entity = $args->getEntity();
        if ($entity instanceof ImageEntity) {
            $this->uploadFile($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args) : void {
        $entity = $args->getEntity();
        if ($entity instanceof ImageEntity) {
            $this->uploadFile($entity);
        }
    }

    public function postLoad(LifecycleEventArgs $args) : void {
        $entity = $args->getEntity();
        if ($entity instanceof ImageEntity) {
            $filePath = $this->uploader->getImageDir() . '/' . $entity->getImageFilePath();
            $thumbnailPath = $this->uploader->getImageDir() . '/' . $entity->getThumbnailPath();
            if (file_exists($filePath)) {
                $entity->setImageFile(new File($filePath));
            }
            if (file_exists($thumbnailPath)) {
                $entity->setThumbnailFile(new File($thumbnailPath));
            }
        }
    }
}
