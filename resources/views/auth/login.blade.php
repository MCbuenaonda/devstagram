@extends('layouts.app')

@section('titulo')
    Inicia Sesión en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-5 md:items-center">
        <div class="md:w-4/12">
            <img src="{{ asset('img/logo.jpeg') }}" alt="logo">
        </div>
        
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf        
                
                @if (session('mensaje'))                
                    <p class="bg-red-200 text-red-700 my-2 p-3 rounded-lg text-sm text-center">{{ session('mensaje') }}</p>
                @endif
                
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="tu email" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">password</label>
                    <input type="password" id="password" name="password" placeholder="tu nombre de usuario" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('password') }}">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <input type="submit" value="iniciar sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection