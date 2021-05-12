<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services;

use App\Entity\ImageEntity;
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

    public function setThumbWidth($width) : void {
        $this->thumbWidth = $width;
    }

    public function setThumbHeight($height) : void {
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
        } catch (Exception $e) {
            $this->logger->critical('Thumbnailer unknown exception: ' . $e);
        }
    }
}
