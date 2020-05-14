@extends('layouts.appAdmin')

@section('title', 'Listado de recipeos')

@section('body-class', 'recipe-page')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>  
@stop

@section('content')

    <section class="mb-4">
      <div class="container mt-3">

              <div class="div_trans8 corner4 p-3">
                  <div class="text-white">
                    <h2 class="text-center text-white">Recetas - {{$category->name}}</h2>                  
                    <h3 class="text-center text-white">Listado de Recetas</h3>        
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                    <p>&nbsp;</p>
                    <div class="">
                        <div class="text-left">
                            <p class="text-center"><a href="#modalRecipeAdd" class="btn btn-burdeos btn-round" data-toggle="modal"  data-target="#modalRecipeAdd">Nueva Receta</a></p>                        
                            <div class="row table-responsive-sm">
                                <div class="col-md-12">
                                @if(count($recipes)>0)
                                    <table id="recipesTable" class="table table-striped text-white">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="30%">Nombre</th>
                                            <th class="text-center" width="30%">Descripción</th>
                                            <th class="text-center" width="20%">Video</th>
                                            <th class="text-center" width="20%">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recipes as $recipe)
                                        <tr>
                                            <td class="text-left" data-toggle="tooltip" title="{{ $recipe->name }}">{{ Str::limit($recipe->name,35,'...') }}</td>                                            
                                            <td class="text-left" data-toggle="tooltip" title="{{ $recipe->description }}">{{ Str::limit($recipe->description,35,'...') }}</td>                                                                           
                                            <td class="text-right">@if(len($recipe->video>0))Ver Video@endif</td>
                                            <td class="text-right">
                                                <a href="#modalRecipeDetail{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeDetail{{$recipe->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                <a href="#modalRecipeEdit{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeEdit{{$recipe->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                <a href="#modalRecipeDelete{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeDelete{{$recipe->id}}"><i class="fa fa-times t-red"></i></a>
                                            </td>                                            
                                        </tr>  
                                          <!-- Modal Recipe Detail -->
                                          <div class="modal fade t-black text-center" id="modalRecipeDetail{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="modalRecipeDetail{{$recipe->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalRecipeDetail{{$recipe->id}}Title">Detalle de {{ $recipe->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">                                                          
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Recipeo: {{ $recipe->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $recipe->description}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Precio: <?php echo ($recipe->price > 0)?"$":"";?>{{ $recipe->price}}</p>
                                                                </div>
                                                            </div>                                                            
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-burdeos" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Recipe Detail -->

                                          <!-- Modal Recipe Edit -->
                                          <div class="modal fade t-black" id="modalRecipeEdit{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="modalRecipeEdit{{$recipe->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalRecipeEdit{{$recipe->id}}Title">Modificar Datos de  {{ $recipe->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/recipes/'.$recipe->id.'/edit') }}" enctype="multipart/form-data">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}
                                                          <input type="hidden" name="category_id" value="{{ $category->id }}">

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                                              <input class="form-control" type="text" name="name" value="{{ $recipe->name }}" autofocus/>
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="email" class="col-form-label text-burdeos">Descipción</label>
                                                              <textarea class="form-control" placeholder="Descripción" rows="5" name="description">{{ $recipe->description }}</textarea>
                                                          </div>      

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Precio:</label>
                                                              <input class="form-control" type="number" name="price" value="{{ $recipe->price }}"/>
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
                                          <!-- End Modal Recipe Edit -->

                                          <!-- Modal Recipe Delete -->
                                          <div class="modal fade t-black text-center" id="modalRecipeDelete{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="modalRecipeDelete{{$recipe->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-danger">
                                                          <h5 class="modal-title text-white" id="modalRecipeDelete{{$recipe->id}}Title">Desea Eliminar el {{ $recipe->name }}?</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Recipeo: {{ $recipe->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $recipe->description}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Precio: <?php echo ($recipe->price > 0)?"$":"";?>{{ $recipe->price}}</p>
                                                                </div>
                                                            </div> 
                                                      </div>
                                                      <div class="modal-footer">
                                                          <form method="post" action="{{ url('/admin/recipes') }}">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <input type="hidden" name="id" value="{{ $recipe->id }}">
                                                              <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cancelar</button>
                                                              <button class="btn btn-outline-danger" type="submit" title="Eliminar la Categoría {{ $recipe->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Recipe Delete -->

                                        @endforeach
                                    </tbody>
                                </table>

                        
                                @else
                                    <h4>No hay recipeos cargados</h4>
                                @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
 <!-- Modal Recipe Add -->

    <div class="modal fade t-black" id="modalRecipeAdd" tabindex="-1" role="dialog" aria-labelledby="modalRecipeAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-burdeos">
                    <h5 class="modal-title text-white" id="modalRecipeAddTitle">Agregar Recipeo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/recipes') }}" enctype="multipart/form-data">
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
    <!-- End Modal Recipe Add -->       
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>   

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 2000);


        $('#modalRecipeAdd').on('shown.bs.modal', function (e) {
            $('#name').focus();
        })

        $(document).ready(function() {
            $('#recipesTable').DataTable({
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
