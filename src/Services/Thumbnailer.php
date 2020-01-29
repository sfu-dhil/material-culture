<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Services;

use AppBundle\Entity\Image;
use AppBundle\Entity\ImageEntity;
use Exception;
use Imagick;
use ImagickException;
use ImagickPixel;
use Psr\Log\LoggerInterface;

/**
 * Description of Thumbnailer.
 *
 * @author mjoyce
 */
class Thumbnailer {
    private $thumbWidth;

    private $thumbHeight;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function setThumbWidth($width) {
        $this->thumbWidth = $width;
    }

    public function setThumbHeight($height) {
        $this->thumbHeight = $height;
    }

    public function thumbnail(ImageEntity $imageEntity) {
        $file = $imageEntity->getImageFile();
        $thumbname = $file->getBasename('.' . $file->getExtension()) . '_tn.png';

        try {
            $magick = new Imagick($file->getPathname());
            $magick->setBackgroundColor(new ImagickPixel('white'));
            $magick->thumbnailimage($this->thumbWidth, $this->thumbHeight, true, true);
            $magick->setImageFormat('png32');
            $path = $file->getPath() . '/' . $thumbname;

            $handle = fopen($path, 'wb');
            if ( ! $handle) {
                $error = error_get_last();

                throw new Exception("Cannot open {$path} for write. " . $error['message']);
            }
            fwrite($handle, $magick->getimageblob());

            return $thumbname;
        } catch (ImagickException $e) {
            $this->logger->critical('Thumbnailer Imagick exception: ' . $e);
        } catch (\Exception $e) {
            $this->logger->critical('Thumbnailer unknown exception: ' . $e);
        }
    }
}
