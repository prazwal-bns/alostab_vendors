<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Facades\File;

final class CopiesDemoUserPhotos
{
    public static function run(): void
    {
        $public = public_path();

        self::ensureDir($public . '/upload/admin_images');
        self::ensureDir($public . '/upload/user_images');
        self::ensureDir($public . '/upload/vendor_images');

        foreach (range(1, 25) as $i) {
            $filename = DemoAssetCatalog::avatarFilename($i);
            $source = $public . '/' . DemoAssetCatalog::avatarSourcePath($i);

            if (is_file($source)) {
                File::copy($source, $public . '/upload/admin_images/' . $filename);
                File::copy($source, $public . '/upload/user_images/' . $filename);
            }
        }

        foreach (range(1, 17) as $i) {
            $filename = DemoAssetCatalog::vendorFilename($i);
            $source = $public . '/' . DemoAssetCatalog::vendorSourcePath($i);

            if (is_file($source)) {
                File::copy($source, $public . '/upload/vendor_images/' . $filename);
            }
        }
    }

    private static function ensureDir(string $path): void
    {
        if (! is_dir($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}
