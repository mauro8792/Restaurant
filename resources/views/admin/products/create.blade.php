@extends('layouts.appAdmin')

@section('body-class', 'product-page')

@section('content')

    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">
        <div class="section text-white">
            <h2 class="text-center">Registrar Nuevo Producto</h2>
            <p>&nbsp;</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label class="control-label">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label">Imagen del producto</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label class="control-label">Categoría del producto: {{$category->name}} </label>
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">Precio del producto</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                         <div class="form-group label-floating">
                            <label class="control-label">Descripción breve</label>
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        </div>
                    </div>
                </div>
                

               

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <button class="btn btn-primary">Registrar producto</button>&nbsp;<a href="{{ url('/admin/products') }}" class="btn btn-warning">Cancelar</a>
                        </div>
                    </div>
                </div>

            </form>
            <p>&nbsp;</p>
        </div>

    </div>
    <p>&nbsp;</p>

@endsection