<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Database\Factories\AdminsFactory;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['show','index']);         
    }

    public function index(User $user) {
        $posts = Admin::where('user_id', $user->id)->latest()->paginate(3);
        return view('admins.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }  
    
    public function comment() {                        
        return view('admins.comment');
    }  

    public function store(Request $request) {                        
        $this->validate($request, [
            'titulo' => ['required', 'max:50'],
            'descripcion' => ['required', 'max:150'],
            'imagen' => ['required']
        ]);

        Admin::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('admins.index', auth()->user());
    } 
    
    public function show(User $user, Admin $post) {
        return view('admins.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Admin $post) {
        $this->authorize('delete', $post);
        $post->delete();
        $imagen_path = public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }     
        return redirect()->route('admins.index', auth()->user());
    }
}
