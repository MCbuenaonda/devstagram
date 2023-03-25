<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Admin $post){
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Admin $post){
        $request->user()->likes()->where('admin_id', $post->id)->delete();
        return back();
    }
}
