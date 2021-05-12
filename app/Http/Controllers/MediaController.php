<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageName = time() . '-' . $request->image;
        $request->image->move(public_path('images'),$imageName);
        Media::create([
            'title' => 1,
            'content' => $imageName,
            'type' => $request->file('image')->getMimeType()
        ]);
    }
}
