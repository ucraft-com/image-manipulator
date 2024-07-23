<?php

declare(strict_types=1);

namespace Uc\ImageManipulator\Tests\Unit;

use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use PHPUnit\Framework\TestCase;
use Uc\ImageManipulator\ImageManipulator;

class ImageManipulatorTest extends TestCase
{
    public function testResize_WithDefinedWidthAndHeight_ResizesImage(): void
    {
        $image = $this->createTempImage(200, 200);
        $manipulator = $this->createManipulatorInstance();

        $resized = $manipulator->resize($image, 100, 100);
        [$width, $height] = getimagesizefromstring($resized);

        $this->assertEquals(100, $width);
        $this->assertEquals(100, $height);
    }

    public function testCrop_WithDefinedWidthAndHeight_CropsImage(): void
    {
        $image = $this->createTempImage(200, 200);
        $manipulator = $this->createManipulatorInstance();

        $cropped = $manipulator->crop($image, 10, 10);

        [$width, $height] = getimagesizefromstring($cropped);

        $this->assertEquals(10, $width);
        $this->assertEquals(10, $height);
    }

    public function testCreateWebP_ConvertsImageToPng(): void
    {
        $image = $this->createTempImage(200, 200);
        $manipulator = $this->createManipulatorInstance();

        $webPContent = $manipulator->convertToWebP($image);
        $webPImage = imagecreatefromwebp('data://image/webp;base64,'.base64_encode($webPContent));

        // Assert that the WebP image was created successfully
        $this->assertNotFalse($webPImage, 'The image is not in WebP format.');
    }

    protected function createManipulatorInstance(): ImageManipulator
    {
        return new ImageManipulator(new ImageManager(new Driver()));
    }

    protected function createTempImage(int $width, int $height): string
    {
        $image = imagecreatetruecolor($width, $height);
        ob_start();
        // Output the image as a PNG file
        imagepng($image);
        $contents = ob_get_clean();
        imagedestroy($image);

        return $contents;
    }
}
