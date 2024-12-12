<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileService
{
    public function save(UploadedFile $file, string $folder): string|bool
    {
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
}
