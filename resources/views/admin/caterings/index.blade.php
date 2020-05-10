@extends('layouts.app')

@section('title', 'Listado de categorías')

@section('body-class', 'product-page')

@section('content')


    <div class="container div_trans8 corner4 mt-4 mb-4 p-4">
        <div class="section text-white">
            <h2 class="text-center">Listado de categorías</h2>
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif
            <p>&nbsp;</p>
            <div class="">
                <div class="text-center">
                    <p><a href="{{ url('/admin/caterings/create') }}" class="btn btn-info btn-round">Nuevo catering</a></p>
                    <div class="row table-responsive-sm">
                        <div class="col-md-12">
                        @if(count($caterings)>0)
                        <table class="table table-striped text-white">
                            <thead>
                                <tr>
                                    <th class="text-center" width="25%">Nombre</th>
                                    <th class="text-center" width="40%">Descripción</th>
                                    <th class="text-center" width="40%">Precio</th>
                                    <th>Imagen</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($caterings as  $catering)
                               
                                <tr>
                                    <td class="text-left">{{ $catering->name }}</td>
                                    <td class="text-left">{{ $catering->description }}</td>
                                    <td class="text-left">{{ $catering->price }}</td>
                                    <td class="text-center"><img src="{{ $catering->featured_image_url }}" height="50"></td>

                                    <td>
                                        <form method="POST" action="{{ url('/admin/caterings') }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $catering->id }}">
                                            
                                            <button class="btn btn-outline-danger" type="submit" title="Eliminar {{ $catering->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>

                                

                                @endforeach
                            </tbody>
                        </table>
                        
                        @else
                            <h4>No hay categorias cargadas</h4>
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