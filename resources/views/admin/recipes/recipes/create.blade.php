@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')

    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">

        <div class="section text-white">
            <h2 class="text-center">Registrar Nueva Receta</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/recipes') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre de la receta</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Imagenes de la receta</label>
                        <input type="file" name="image[]" id="image" multiple class="form-control">
                        {{-- <input type="file" name="image"> --}}
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Video de la receta url de youtube</label>
                        <input type="string" name="video">
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Ingredientes:" rows="5" name="ingredients">{{ old('ingredients') }}</textarea>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Paso a paso de la receta:" rows="5" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary">Registrar categoría</button>&nbsp;<a href="{{ url('/admin/categories') }}" class="btn btn-warning">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <p>&nbsp;</p>
@endsection