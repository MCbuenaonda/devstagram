@extends('layouts.app')

@section('titulo')
    Crear una nueva publicacion
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagen.store') }}" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center" enctype="multipart/form-data">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl">
            <form action="{{ route('admins.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" id="titulo" name="titulo" placeholder="ingresa un titulo" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">                    
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" placeholder="ingresa un descripcion" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">
                        {{ old('descripcion') }}
                    </textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="crear comentario" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection

@push('scripts')    
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone("#dropzone", {
            dictDefaultMessage: "Sube aqui tu imagen",
            acceptedFiles: ".png, .jpg, .jpeg, .gif",
            addRemoveLinks: true,
            dictRemoveFile: "Borrar archivo",
            maxFiles: 1,
            uploadMultiple: false,
            init: function() {
                if(document.querySelector('[name="imagen"]').value.trim()) {
                    const imgPublicada = {}
                    imgPublicada.size = 1234;
                    imgPublicada.name = document.querySelector('[name="imagen"]').value;
                    this.options.addedfile.call(this, imgPublicada);
                    this.options.thumbnail.call(this, imgPublicada, `/uploads/${imgPublicada.name}`);
                    imgPublicada.previewElement.classList.add('dz-success', 'dz-complete');
                }
            }
        });

        dropzone.on('success', function(file, response){
            document.querySelector('[name="imagen"]').value = response.imagen;
        });

        dropzone.on('removedFile', function(){
            document.querySelector('[name="imagen"]').value = '';
        });
    </script>
@endpush