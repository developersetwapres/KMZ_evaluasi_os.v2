<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function uploadTempImage(ImageUploadRequest $request)
    {
        $path = $request->file('image')->store('', 'temp');
        return session()->flash('pathTemp', 'temp/' . $path);
    }

    public function moveImageFromTemp(?string $imageUrl, ?string $role): ?string
    {
        $imageUrlNew = Str::replace('temp/', '', $imageUrl);
        $imageUrlNew = Str::replace('images/' . $role . '/', '', $imageUrlNew);

        $temp = Storage::disk('temp');
        $sourcePath = $temp->path($imageUrlNew);

        // tentukan folder tujuan di public/image/user
        $destinationDir = storage_path('app/public/images/' . $role);

        // pastikan folder tujuan ada
        if (! File::exists($destinationDir)) {
            File::makeDirectory($destinationDir, 0755, true);
        }

        // pindahkan file dari temp ke tujuan
        if (File::exists($sourcePath)) {
            File::move($sourcePath, $destinationDir . DIRECTORY_SEPARATOR . $imageUrlNew);
        }

        // hapus semua isi folder temp
        $allTempFiles = $temp->allFiles();
        if (!empty($allTempFiles)) {
            $temp->delete($allTempFiles);
        }

        return 'images/' . $role . "/" . $imageUrlNew;
    }
}
