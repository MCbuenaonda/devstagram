@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="{{ $post->titulo }}">
            <div class="p-3 flex items-center gap-4">
                @auth   
                    <livewire:like-post :post="$post" />
                    
                    {{-- @if ($post->checkLike(auth()->user()))
                    <form action="{{ route('admins.likes.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="my-4">

                        </div>
                    </form>
                    @else                        
                        <form action="{{ route('admins.likes.store', $post) }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                    </svg>                      
                                </button>
                            </div>
                        </form>
                    @endif --}}

                @endauth
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

            @auth      
                @if($post->user_id === auth()->user()->id)          
                    <form action="{{ route('admins.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer" value="Eliminar publicacion">
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow p-5 bg-white mb-5">
                @auth                    
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                comentario
                            </label>
                            <textarea id="comentario" name="comentario" placeholder="ingresa un comentario" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror">
                                {{ old('comentario') }}
                            </textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                            @enderror
                        </div>  
                        
                        <input type="submit" value="crear comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('admins.index', $comentario->user) }}">
                                {{ $comentario->user->username }}
                            </a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-gray-500 text-sm">{{ $comentario->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach                    
                </div>
            </div>
        </div>
    </div>
@endsection