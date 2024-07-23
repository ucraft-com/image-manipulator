# ImageManipulator package

ImageManipulator is a comprehensive package designed for advanced image processing tasks. It provides robust functionality for various image manipulations, ensuring both flexibility and efficiency in handling images.

## Features

- **Resize**: Dynamically adjust the dimensions of images while maintaining aspect ratio or using custom scaling.
- **Trim**: Automatically remove unnecessary borders or whitespace from images to optimize visual presentation.
- **Crop**: Extract specific portions of an image based on defined coordinates or focus areas.
- **WebP Conversion**: Efficiently convert images to the WebP format, ensuring optimal balance between image quality and file size for web use.

## Requirements

- **PHP**: 8.1 or higher
- **Imagick PHP extension**: You need to have the [Imagick PHP extension](https://www.php.net/manual/en/book.imagick.php) installed and enabled to use the ImageManipulator library.

## Requirements

- **PHP**: 8.1 or higher
- **Imagick PHP extension**: You need to have the [Imagick PHP extension](https://www.php.net/manual/en/book.imagick.php) installed and enabled to use the ImageManipulator library.

## Laravel Integration

If you are using the Laravel framework, the `ImageManipulatorServiceProvider` service provider is available to register the ImageManipulator with the appropriate driver.

To integrate with Laravel, follow these steps:

1. Add the service provider to the `providers` array in your `config/app.php` file:

    ```php
    'providers' => [
        // Other service providers...

        Uc\ImageManipulator\ImageManipulatorServiceProvider::class,
    ],
    ```

2. (Optional) Publish the configuration file if you need to customize the settings:

    ```bash
    php artisan vendor:publish --provider="Uc\ImageManipulator\ImageManipulatorServiceProvider"
    ```

This setup will register ImageManipulator with Laravel, allowing you to use it with the Laravel service container and configuration management.
## Installation

To install the ImageManipulator library, use Composer:

```bash
composer require ucraft-com/image-manipulator
```

```php
use Uc\ImageManipulator\ImageManipulator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

// Load an image
$contents = file_get_contents('path/to/image.jpg');
$im = new ImageManipulator(new ImageManager(new Driver()));

// Resize the image to 800x600 pixels
$resizedImage = $im->resize($contents, 800, 600);

// Crop the image from (100, 100) pixels
$croppedImage = $im->crop($contents, 100, 100);

// Automatically trim borders or whitespace
$trimmedImage = $im->trim($contents);

// Convert the image to WebP format
$webpImage = $im->convertToWebP($contents);
