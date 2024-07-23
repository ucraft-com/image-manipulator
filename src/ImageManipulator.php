<?php

declare(strict_types=1);

namespace Uc\ImageManipulator;

use Intervention\Image\ImageManager;

/**
 * ImageManipulator is a comprehensive library designed for advanced image processing tasks.
 * It provides robust functionality for various image manipulations, including:
 *
 * - Resize: Dynamically adjust the dimensions of images while maintaining aspect ratio or using custom scaling.
 * - Trim: Automatically remove unnecessary borders or whitespace from images to optimize visual presentation.
 * - Crop: Extract specific portions of an image based on defined coordinates or focus areas.
 * - WebP Conversion: Efficiently convert images to the WebP format, ensuring optimal balance between image quality and
 * file size for web use.
 *
 * With ImageManipulator, developers can seamlessly integrate high-performance image processing capabilities into their
 * applications, ensuring both flexibility and efficiency.
 *
 * @package Uc\ImageManipulator
 * @author  Tigran Mesropyan <tiko@ucraft.com>
 */
class ImageManipulator
{
    /**
     * ImageManipulator constructor.
     *
     * @param \Intervention\Image\ImageManager $manager
     */
    public function __construct(protected ImageManager $manager)
    {
    }

    /**
     * Resize given content by given width and height and return modified content.
     * If width or height not provided or given value equals zero,
     * make no manipulation and return not modified content.
     *
     * @param string   $content
     * @param int|null $width
     * @param int|null $height
     *
     * @return string
     */
    public function resize(string $content, ?int $width, ?int $height): string
    {
        $image = $this->manager->read($content);

        if (!$width && !$height) {
            return $image->encode()->toString();
        }

        return $image->scale($width, $height)->encode()->toString();
    }

    /**
     * Crop given content by given width, height, x and y.
     * Return modified content.
     *
     * @param string $content
     * @param int    $width
     * @param int    $height
     * @param array  $options
     *
     * @return string
     */
    public function crop(string $content, int $width, int $height, array $options = []): string
    {
        $x = $options['x'] ?? 0;
        $y = $options['y'] ?? 0;
        $background = $options['background'] ?? 'ffffff';
        $pos = $options['position'] ?? 'top-left';

        return $this->manager
            ->read($content)
            ->crop($width, $height, $x, $y, background: $background, position: $pos)
            ->encode()
            ->toString();
    }

    /**
     * Trim the image by removing border areas of similar color within the given tolerance.
     *
     * @param string $content
     *
     * @return string
     */
    public function trim(string $content): string
    {
        return $this->manager
            ->read($content)
            ->trim()
            ->encode()
            ->toString();
    }

    /**
     * Convert given image content into WebP format.
     *
     * @param string $content
     *
     * @return string
     */
    public function convertToWebP(string $content): string
    {
        return $this->manager
            ->read($content)
            ->toWebp(100)
            ->toString();
    }
}
