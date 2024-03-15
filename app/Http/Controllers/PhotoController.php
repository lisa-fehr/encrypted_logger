<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PhotoController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function show(Photo $photo)
    {
        return response()->stream(function() use($photo) {
            echo Crypt::decrypt(Storage::get($photo->img));
        }, 200, ['Content-type' => 'image/png']);
    }
}
