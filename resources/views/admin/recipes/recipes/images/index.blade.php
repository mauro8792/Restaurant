@extends('layouts.app')

@section('title', 'Imágenes de productos')

@section('body-class', 'product-page')

@section('content')

    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">
        <div class="section text-white">
            <h2 class="text-center">Imágenes de la receta {{ $recipe->name }}</h2>
            <p>&nbsp;</p>
            <form method="post" action="{{ url('/admin/recipes/agregar-imagen') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="image" required>
                <input type='hidden' name="recipe_id" value='{{$recipe->id}}'>
                <button type="submit" class="btn btn-primary btn-round">Subir nueva imagen</button>&nbsp; <a href="{{ url('/admin/recipes/') }}" class="btn btn-warning btn-round">Volver al listado de recetas</a>
            </form>

            <hr class="text-white">

            <div class="row d-flex justify-content-center">
            @foreach ($images as $image)
            @php
                // dd($image->featured_image_url );
            @endphp
                <div class="card text-center m-1">
                    <img src="{{ $image->featured_image_url }}" width="250" class="m-1">
                    <div class="card-body">
                        <form method="post" action="{{ url('/admin/recipes/eliminar-imagen') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <button type="submit" class="btn btn-danger">Eliminar imagen</button>
                           
                        </form>
                    </div>
                </div>
            @endforeach
            </div>

        </div>
    </div>
    <p>&nbsp;</p>
@endsection