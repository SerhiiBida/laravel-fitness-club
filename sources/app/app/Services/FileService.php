<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileService
{
    public function save(UploadedFile $file, string $folder): string|bool
    {
        // Создаем папку
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        return $file->store($folder, 'public');
    }

    public function download(string $path): ?StreamedResponse
    {
        if (Storage::exists($path)) {
            return Storage::download($path);
        }

        return null;
    }

    public function delete(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }

    // Для dom-pdf
    public function generateUniquePath(string $folder, string $fileType, string $fileName = ''): array
    {
        // Создаем папку
        if (!Storage::exists($folder)) {
            Storage::makeDirectory($folder);
        }

        $currentDate = Carbon::now()->format('Y-m-d_H-i-s');

        if ($fileName) {
            $fileName .= '_';
        }

        $path = $folder . '/' . $fileName . $currentDate . uniqid('', true) . ".$fileType";

        return [
            'fullPath' => public_path($path),
            'path' => $path,
        ];
    }

    public function hasFile(string $path): bool
    {
        return Storage::exists($path);
    }
}
