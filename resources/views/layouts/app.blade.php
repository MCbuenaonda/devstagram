<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <title>Devstagram</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                <a href="/">Devstagram</a> 
            </h1>

            @auth
                <nav class="flex gap-3 items-center">
                    <a href="{{ route('admins.comment') }}" class="flex items-center gap-2 p-2 bg-white border text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>                          
                        Comentar
                    </a>

                    <a class="font-bold text-grat-600 text-sm" href="{{ route('admins.index', auth()->user()) }}">
                        Bienvenido: <span class="font-normal">{{ auth()->user()->username }}</span>
                    </a>                    

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="font-bold uppercase text-grat-600 text-sm" type="submit">
                            Cerrar sesion
                        </button>                    
                    </form>
                </nav>
            @endauth

            @guest                
                <nav class="flex gap-3 items-center">
                    <a class="font-bold uppercase text-grat-600 text-sm" href="{{ route('login') }}">Login</a> 
                    <a class="font-bold uppercase text-grat-600 text-sm" href="{{ route('register') }}">Crear cuenta</a>
                </nav>
            @endguest
            
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devstagram - Todos los derechos reservados {{ now()->year}}
    </footer>

    @stack('scripts')
    @livewireScripts
</body>

</html>