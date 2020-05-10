@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')

    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">

        <div class="section text-white">
            <h2 class="text-center">Registrar Nueva Catering</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/caterings') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Nombre del catering</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label">Precio del catering</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Imagen del catering</label>
                        <input type="file" name="image">
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Descripción del catering" rows="5" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary">Registrar catering</button>&nbsp;<a href="{{ url('/admin/caterings') }}" class="btn btn-warning">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <p>&nbsp;</p>
@endsection