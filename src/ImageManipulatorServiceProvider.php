<?php

declare(strict_types=1);

namespace Uc\ImageManipulator;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

/**
 * Service provider of the package.
 *
 * @author Tigran Mesropyan <tiko@ucraft.com>
 */
class ImageManipulatorServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ImageManipulator::class, function () {
            return new ImageManipulator(
                new ImageManager(
                    new Driver()
                )
            );
        });
    }
}
