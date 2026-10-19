<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;
use Throwable;

class StoredImage
{
    private const MAX_EDGE = 1600;

    private const JPEG_QUALITY = 60;

    public static function store(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $path = $file->store($directory, $disk);

        if ($path === false) {
            return $path;
        }

        self::compressFile(Storage::disk($disk)->path($path));

        return $path;
    }

    public static function compressFile(string $absolute): void
    {
        if (! is_file($absolute)) {
            return;
        }

        $info = @getimagesize($absolute);

        if ($info === false) {
            return;
        }

        $format = self::formatForType($info[2] ?? 0);

        if ($format === null) {
            return;
        }

        $temp = dirname($absolute).DIRECTORY_SEPARATOR.'opt-'.bin2hex(random_bytes(4)).'.'.$format;

        try {
            $image = Image::load($absolute)
                ->fit(Fit::Max, self::MAX_EDGE, self::MAX_EDGE)
                ->quality($format === 'png' ? 10 : self::JPEG_QUALITY)
                ->format($format);
            $image->save($temp);
            unset($image);
        } catch (Throwable $exception) {
            if (is_file($temp)) {
                unlink($temp);
            }

            Log::warning('Image compression failed.', [
                'file' => $absolute,
                'error' => $exception->getMessage(),
            ]);

            return;
        }

        clearstatcache(true, $absolute);
        clearstatcache(true, $temp);

        $optimizedSize = is_file($temp) ? filesize($temp) : false;

        if ($optimizedSize === false || $optimizedSize === 0 || $optimizedSize >= filesize($absolute)) {
            if (is_file($temp)) {
                unlink($temp);
            }

            return;
        }

        if (! self::replace($absolute, $temp)) {
            if (is_file($temp)) {
                unlink($temp);
            }
        }
    }

    private static function formatForType(int $type): ?string
    {
        return match ($type) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_GIF => 'gif',
            IMAGETYPE_WEBP => 'webp',
            IMAGETYPE_BMP => 'jpg',
            default => defined('IMAGETYPE_AVIF') && $type === IMAGETYPE_AVIF ? 'avif' : null,
        };
    }

    private static function replace(string $target, string $temp): bool
    {
        if (@rename($temp, $target)) {
            return true;
        }

        if (! @copy($temp, $target)) {
            return false;
        }

        unlink($temp);

        return true;
    }
}
