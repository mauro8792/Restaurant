@extends('layouts.appAdmin')

@section('title', 'Menú - Categorías')

@section('body-class', 'categories-page')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>  
@stop

@section('content')
    <section class="mb-4">
      <div class="container mt-3">

              <div class="div_trans8 corner4 p-3">
                  <div class="text-white">
                      <h2 class="text-center text-white">Menú</h2>                  
                      <h3 class="text-center text-white">Listado de Categorías</h3>
                      @if (session('notification'))
                          <div class="alert alert-success">
                              {{ session('notification') }}
                          </div>
                      @endif
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                      <p>&nbsp;</p>
                      <div class="">
                          <div class="text-left">
                              <p class="text-center"><a href="#modalCategoryAdd" class="btn btn-burdeos btn-round" data-toggle="modal"  data-target="#modalCategoryAdd">Nueva Categoría</a></p>
                              <div class="row table-responsive-sm">
                                  <div class="col-md-12">
                                  @if(count($categories)>0)
                                      <table id="categoriesTable" class="table table-striped text-white">
                                      <thead>
                                          <tr>
                                            <th class="text-center" width="30%">Nombre</th>
                                            <th class="text-center" width="30%">Descripcion</th>                                            
                                            <th class="text-center" width="10%">Estado</th>
                                            <th class="text-center" width="10%">Imagen</th>
                                            <th class="text-right" width="20%">Opciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($categories as $category)
                                          <tr>
                                            <td class="text-left" data-toggle="tooltip" title="{{ $category->name }}">{{ Str::limit($category->name,35,'...') }}</td>
                                            <td class="text-left" data-toggle="tooltip" title="{{ $category->description }}">{{ Str::limit($category->description,35,'...') }}</td>                                            
                                            <?php $show = ($category->show)?"fa fa-eye":"fa fa-eye-slash";?>
                                            <td class="text-center"><i class="{{ $show }} text-burdeos"></i></td>                                                                                       
                                            <td class="text-center"><img src="{{ $category->featured_image_url }}" height="50"></td>
                                            <td class="text-right">
                                                    <a href="#modalCategoryDetail{{$category->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $category->name }}" data-toggle="modal"  data-target="#modalCategoryDetail{{$category->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                    <a href="#modalCategoryEdit{{$category->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar {{ $category->name }}" data-toggle="modal"  data-target="#modalCategoryEdit{{$category->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                    <a href="#modalCategoryDelete{{$category->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar {{ $category->name }}" data-toggle="modal"  data-target="#modalCategoryDelete{{$category->id}}"><i class="fa fa-times t-red"></i></a>
                                                    <a href="{{ url('/admin/categories/'.$category->id.'/products') }}" class="btn btn-outline-dark btn-sm" type="submit" title="Listado de Productos de {{ $category->name }}"><i class="fa fa-beer text-burdeos"></i></a>
                                            </td>
                                          </tr>

                                          <!-- Modal Category Detail -->
                                          <div class="modal fade t-black text-center" id="modalCategoryDetail{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCategoryDetail{{$category->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalCategoryDetail{{$category->id}}Title">Detalle de {{ $category->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <img src="{{ asset($category->featured_image_url) }}" alt="Thumbnail Image" class="img-thumbnail">
                                                                </div>
                                                            </div>                                                             
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Categoría: {{ $category->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $category->description}}</p>
                                                                </div>
                                                            </div>
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-burdeos" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Category Detail -->

                                          <!-- Modal Category Edit -->
                                          <div class="modal fade t-black" id="modalCategoryEdit{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCategoryEdit{{$category->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalCategoryEdit{{$category->id}}Title">Modificar Datos de  {{ $category->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/categories/'.$category->id.'/edit') }}" enctype="multipart/form-data">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}
                                                          <input type="hidden" name="id" value="{{ $category->id }}">

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                                              <input class="form-control" type="text" name="name" value="{{ $category->name }}" autofocus/>
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="image" class="col-form-label text-burdeos">Imágen: </label>
                                                              <input class="form-control" type="file" name="image" value="{{ $category->image }}">
                                                                @if ($category->image)
                                                                <p class="font12">
                                                                    Subir sólo si desea reemplazar la
                                                                    <a href="{{ asset('/images/categories/'.$category->image) }}" target="_blank">imagen actual</a>
                                                                </p>
                                                                @endif                                                              
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="email" class="col-form-label text-burdeos">Descipción</label>
                                                              <textarea class="form-control" placeholder="Descripción" rows="5" name="description">{{ $category->description }}</textarea>
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
                                          <!-- End Modal Category Edit -->

                                          <!-- Modal Category Delete -->
                                          <div class="modal fade t-black text-center" id="modalCategoryDelete{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCategoryDelete{{$category->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-danger">
                                                          <h5 class="modal-title text-white" id="modalCategoryDelete{{$category->id}}Title">Desea Eliminar la Categoría  {{ $category->name }}?</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <img src="{{ asset($category->featured_image_url) }}" alt="Thumbnail Image" class="img-thumbnail">
                                                                </div>
                                                            </div>                                                          
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">{{ $category->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $category->description}}</p>
                                                                </div>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <form method="post" action="{{ url('/admin/categories') }}">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <input type="hidden" name="id" value="{{ $category->id }}">
                                                              <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cancelar</button>
                                                              <button class="btn btn-outline-danger" type="submit" title="Eliminar la Categoría {{ $category->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Category Delete -->

                                          @endforeach
                                      </tbody>
                                  </table>

                                  @else
                                      <h4 class="text-white">No hay Categorías cargadas</h4>
                                  @endif
                                  </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
      </div>
    
    </section>
    <!-- END section -->
 
    
    <!-- Modal Category Add -->

    <div class="modal fade t-black" id="modalCategoryAdd" tabindex="-1" role="dialog" aria-labelledby="modalCategoryAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-burdeos">
                    <h5 class="modal-title text-white" id="modalCategoryAddTitle">Agregar Categoría</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/categories') }}" enctype="multipart/form-data">
                    <div class="modal-body text-left">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="image" class="col-form-label text-burdeos">Imágen:</label>
                                <input class="form-control" type="file" name="image">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="description" class="col-form-label text-burdeos">Descripción:</label>                                
                                <textarea class="form-control" placeholder="Descripción" rows="5" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-burdeos">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Category Add -->    
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>   

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 2000);


        $('#modalCategoryAdd').on('shown.bs.modal', function (e) {
            $('#name').focus();
        })

        $(document).ready(function() {
            $('#categoriesTable').DataTable({
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
                    {"bSortable": true},                    
                    {"bSortable": false, 'searchable': false},
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


