@extends('layouts.appAdmin')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>  
@stop

@section('content')

    <section class="mb-4">
      <div class="container mt-3">

              <div class="div_trans8 corner4 p-3">
                  <div class="text-white">
                    <h2 class="text-center text-white">Menú - {{$category->name}}</h2>                  
                    <h3 class="text-center text-white">Listado de Productos</h3>        
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                    <p>&nbsp;</p>
                    <div class="">
                        <div class="text-left">
                            <p class="text-center"><a href="#modalProductAdd" class="btn btn-burdeos btn-round" data-toggle="modal"  data-target="#modalProductAdd">Nuevo producto</a></p>                        
                            <div class="row table-responsive-sm">
                                <div class="col-md-12">
                                @if(count($products)>0)
                                    <table id="productsTable" class="table table-striped text-white">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="30%">Nombre</th>
                                            <th class="text-center" width="30%">Descripción</th>
                                            <th class="text-center" width="20%">Precio</th>
                                            <th class="text-center" width="20%">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="text-left">{{ $product->name }}</td>
                                            <td class="text-left">{{ Str::limit($product->description,35,'...') }}</td>                                 
                                            <td class="text-right">@if($product->price>0)$@endif {{ $product->price }}</td>
                                            <td class="text-right">
                                                <a href="#modalProductDetail{{$product->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $product->name }}" data-toggle="modal"  data-target="#modalProductDetail{{$product->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                <a href="#modalProductEdit{{$product->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar Producto {{ $product->name }}" data-toggle="modal"  data-target="#modalProductEdit{{$product->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                <a href="#modalProductDelete{{$product->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar Producto {{ $product->name }}" data-toggle="modal"  data-target="#modalProductDelete{{$product->id}}"><i class="fa fa-times t-red"></i></a>
                                            </td>                                            
                                        </tr>  
                                          <!-- Modal Product Detail -->
                                          <div class="modal fade t-black text-center" id="modalProductDetail{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="modalProductDetail{{$product->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalProductDetail{{$product->id}}Title">Detalle de {{ $product->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">                                                          
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Producto: {{ $product->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $product->description}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Precio: <?php echo ($product->price > 0)?"$":"";?>{{ $product->price}}</p>
                                                                </div>
                                                            </div>                                                            
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-burdeos" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Product Detail -->

                                          <!-- Modal Product Edit -->
                                          <div class="modal fade t-black" id="modalProductEdit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="modalProductEdit{{$product->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalProductEdit{{$product->id}}Title">Modificar Datos de  {{ $product->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/products/'.$product->id.'/edit') }}" enctype="multipart/form-data">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}
                                                          <input type="hidden" name="category_id" value="{{ $category->id }}">

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                                              <input class="form-control" type="text" name="name" value="{{ $product->name }}" autofocus/>
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="email" class="col-form-label text-burdeos">Descipción</label>
                                                              <textarea class="form-control" placeholder="Descripción" rows="5" name="description">{{ $product->description }}</textarea>
                                                          </div>      

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Precio:</label>
                                                              <input class="form-control" type="number" name="price" value="{{ $product->price }}"/>
                                                          </div>                                                                                                              
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cerrar</button>
                                                          <button type="submit" class="btn btn-burdeos">Modificar</button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                          </div>
                                          <!-- End Modal Product Edit -->

                                          <!-- Modal Product Delete -->
                                          <div class="modal fade t-black text-center" id="modalProductDelete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="modalProductDelete{{$product->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-danger">
                                                          <h5 class="modal-title text-white" id="modalProductDelete{{$product->id}}Title">Desea Eliminar el {{ $product->name }}?</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Producto: {{ $product->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $product->description}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Precio: <?php echo ($product->price > 0)?"$":"";?>{{ $product->price}}</p>
                                                                </div>
                                                            </div> 
                                                      </div>
                                                      <div class="modal-footer">
                                                          <form method="post" action="{{ url('/admin/products') }}">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <input type="hidden" name="id" value="{{ $product->id }}">
                                                              <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cancelar</button>
                                                              <button class="btn btn-outline-danger" type="submit" title="Eliminar la Categoría {{ $product->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Product Delete -->

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
        </div>
    </section>
 <!-- Modal Product Add -->

    <div class="modal fade t-black" id="modalProductAdd" tabindex="-1" role="dialog" aria-labelledby="modalProductAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-burdeos">
                    <h5 class="modal-title text-white" id="modalProductAddTitle">Agregar Producto</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
                    <div class="modal-body text-left">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                            <input class="form-control" type="text" name="name" autofocus/>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label text-burdeos">Descipción</label>
                            <textarea class="form-control" placeholder="Descripción" rows="5" name="description"></textarea>
                        </div>      

                        <div class="form-group">
                            <label for="name" class="col-form-label text-burdeos">Precio:</label>
                            <input class="form-control" type="number" name="price">
                        </div>   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="category_id" value="{{$category->id}}">                        
                        <button type="submit" class="btn btn-burdeos">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Product Add -->       
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>   

    <script>
        $(document).ready(function() {
            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });


        $('#modalProductAdd').on('shown.bs.modal', function (e) {
            $('#name').focus();
        })

        $(document).ready(function() {
            $('#productsTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "lengthMenu":		[[5, 10, 20, 30, 50, 100, -1], [ 5, 10, 20, 30, 50, 100, "Todos"]],
                "iDisplayLength":	10,
                "bJQueryUI":		false,
                "aoColumns":[
                    {"bSortable": true},
                    {"bSortable": false},
                    {"bSortable": true, 'searchable': false},
                    {"bSortable": false, 'searchable': false}
                ],

            });
            $("input.form-control.form-control-sm").attr('placeholder', 'Buscar...');
            $("input.form-control.form-control-sm").attr('size', 30);
            $("input.form-control.form-control-sm").focus();
            $("ul.pagination").addClass("pagination-sm");
        } );
    </script>
@endsection
