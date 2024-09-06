<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

trait FileUploadTrait
{
    /**
     * Upload a file to the specified directory.
     * If the file is an image, it will be resized before uploading.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int|null $width
     * @param int|null $height
     * @return string File path
     */
    public function uploadFile(UploadedFile $file, string $directory, ?int $width = null, ?int $height = null): string
    {
        if ($this->isImage($file)) {
            $filePath = $this->resizeAndSaveImage($file, $directory, $width, $height);
        } else {
            $filePath = $file->store($directory);
        }

        return $filePath;
    }

    /**
     * Update a file by deleting the old file and uploading a new one.
     * If the file is an image, it will be resized before uploading.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $oldFilePath
     * @param int|null $width
     * @param int|null $height
     * @return string File path
     */
    public function updateFile(UploadedFile $file, string $directory, ?string $oldFilePath = null, ?int $width = null, ?int $height = null): string
    {
        // Delete the old file if it exists
        if ($oldFilePath && Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Upload the new file
        return $this->uploadFile($file, $directory, $width, $height);
    }

    /**
     * Delete a file from the storage.
     *
     * @param string $filePath
     * @return bool
     */
    public function deleteFile(string $filePath): bool
    {
        if (Storage::exists($filePath)) {
            return Storage::delete($filePath);
        }

        return false;
    }

    /**
     * Check if the uploaded file is an image.
     *
     * @param UploadedFile $file
     * @return bool
     */
    protected function isImage(UploadedFile $file): bool
    {
        return in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }

    /**
     * Resize and save the image to the specified directory.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int|null $width
     * @param int|null $height
     * @return string File path
     */
    protected function resizeAndSaveImage(UploadedFile $file, string $directory, ?int $width, ?int $height): string
    {
        $image = Image::make($file);

        // Resize the image if dimensions are provided
        if ($width || $height) {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Generate a unique filename
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $directory . '/' . $filename;

        // Save the resized image
        Storage::put($path, (string) $image->encode());

        return $path;
    }
}
