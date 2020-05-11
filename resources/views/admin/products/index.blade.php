@extends('layouts.appAdmin')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')

@section('content')

    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">
        <div class="text-white">
            <h2 class="text-center">Listado de productos</h2>
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            <p>&nbsp;</p>
            <div class="">
                <div class="text-center">
                    <p><a href="{{ url('/admin/products/create') }}" class="btn btn-info btn-round">Nuevo producto</a></p>
                    <div class="row table-responsive-sm">
                        <div class="col-md-12">
                        @if(count($products)>0)
                            <table class="table table-striped text-white">
                            <thead>
                                <tr>
                                    <th class="text-center" width="15%">Nombre</th>
                                    <th class="text-center" width="30%">Descripción</th>
                                    <th class="text-center" width="15%">Precio</th>
                                    <th class="text-center" width="20%">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                   
                                    <td class="text-left">{{ $product->name }}</td>
                                    <td class="text-left">{{ Str::limit($product->description,50,'...') }}</td>                                 
                                    <td class="text-right">@if($product->price>0)$@endif {{ $product->price }}</td>
                                    <td class="text-center">
                                        <form method="post" action="{{ url('/admin/products') }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-outline-danger" type="submit" title="Eliminar {{ $product->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>     
                                @endforeach
                            </tbody>
                        </table>
                   
                        @else
                            <h4>No hay productos cargados</h4>
                        @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
 </div>
        <p>&nbsp;</p>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });
    </script>
@endsection