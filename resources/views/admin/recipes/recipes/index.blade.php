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
                                    <table id="recipesTable" class="table table-striped text-white">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="30%">Nombre</th>
                                            <th class="text-center" width="40%">Descripción</th>
                                            <th class="text-center" width="10%">Video</th>
                                            <th class="text-center" width="20%">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recipes as $recipe)
                                        <tr>
                                            <td class="text-left" data-toggle="tooltip" title="{{ $recipe->name }}">{{ Str::limit($recipe->name,35,'...') }}</td>                                            
                                            <td class="text-left" data-toggle="tooltip" title="{{ $recipe->description }}">{{ Str::limit($recipe->description,35,'...') }}</td>                                                                           

                                            <td class="text-right">@if($recipe->video >" ") Ver video @endif</td>

                                            <td class="text-right">
                                                <a href="#modalRecipeDetail{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeDetail{{$recipe->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                <a href="#modalRecipeEdit{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeEdit{{$recipe->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                <a href="#modalRecipeDelete{{$recipe->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar {{ $recipe->name }}" data-toggle="modal"  data-target="#modalRecipeDelete{{$recipe->id}}"><i class="fa fa-times t-red"></i></a>
                                                <a href="{{ url('/admin/recipes/'.$recipe->id.'/images') }}" class="btn btn-outline-dark btn-sm" type="submit" title="Ver imágenes {{ $recipe->name }}" "><i class="fa fa-camera text-burdeos"></i></a>                                                
                                            </td>                                            
                                        </tr>  
                                          <!-- Modal Recipe Detail -->
                                          <div class="modal fade t-black text-center" id="modalRecipeDetail{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="modalRecipeDetail{{$recipe->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-yellow">
                                                          <h5 class="modal-title t-black" id="modalRecipeDetail{{$recipe->id}}Title">Detalle de {{ $recipe->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">                                                          
                                                             <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos"><b>Receta:</b><BR>{{ $recipe->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <?php $str = str_replace("\n", ' - ', $recipe->ingredients);?>
                                                                    <pre class="text-burdeos"><b>Ingredientes:</b><BR>{{ $str }}</pre>
                                                                </div>                                                            
                                                                <div class="col-md-6">                                                             
                                                                    <pre class="text-burdeos"><b>Descripción:</b><BR>{{ $recipe->description}}</pre>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos"><b>Video:</b><BR>{{ $recipe->video}}</p>
                                                                </div>
                                                            </div>                                                          
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn bg-yellow t-black" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Recipe Detail -->

                                          <!-- Modal Recipe Edit -->
                                          <div class="modal fade t-black" id="modalRecipeEdit{{$recipe->id}}" tabindex="-1" role="dialog" aria-labelledby="modalRecipeEdit{{$recipe->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-blue">
                                                          <h5 class="modal-title text-white" id="modalRecipeEdit{{$recipe->id}}Title">Modificar Datos de  {{ $recipe->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/recipes/'.$recipe->id.'/edit') }}" enctype="multipart/form-data">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="name" class="col-form-label text-burdeos"><b>Receta:</b></label>
                                                                    <input class="form-control" placeholder="Nombre" type="text" name="name" value="{{ $recipe->name }}" autofocus/>
                                                                    <input type="hidden" name="recipe_id" value="{{$recipe->id}}">
                                                                    <input type="hidden" name="recipecategory_id" value="{{$category->id}}"> 
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="ingredients" class="col-form-label text-burdeos"><b>Ingredientes:</b></label>
                                                                    <textarea class="form-control" placeholder="Lista de Ingredientes" rows="5" name="ingredients"> {{ $recipe->ingredients }} </textarea>
                                                                </div> 

                                                                <div class="form-group col-md-6">
                                                                    <label for="description" class="col-form-label text-burdeos"><b>Descripción</b></label>
                                                                    <textarea class="form-control" placeholder="Descripción paso a paso" rows="5" name="description"> {{ $recipe->description }}" </textarea>
                                                                </div>                         
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="video" class="col-form-label text-burdeos"><b>Link de Video:</b></label>
                                                                    <input class="form-control" placeholder="Link de Video" type="text" name="video" value="{{ $recipe->video }}" >
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="image" class="col-form-label text-burdeos"><b>Imágenes:</b></label>
                                                                    <input class="form-control" placeholder="Imágenes" type="file" name="image[]" multiple>
                                                                </div>   
                                                            </div>                                                                                                       
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cerrar</button>
                                                          <button type="submit" class="btn bg-blue t-white">Modificar</button>
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
                                                                    <p class="text-burdeos"><b>Receta:</b><BR>{{ $recipe->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <pre class="text-burdeos"><b>Ingredientes:</b><BR>{{ $recipe->ingredients}}</pre>
                                                                </div>                                                            
                                                                <div class="col-md-6">                                                             
                                                                    <pre class="text-burdeos"><b>Descripción:</b><BR>{{ $recipe->description}}</pre>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos"><b>Video:</b><BR>{{ $recipe->video}}</p>
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
                    <h5 class="modal-title text-white" id="modalRecipeAddTitle">Agregar Receta a {{$category->name}}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/recipes') }}" enctype="multipart/form-data">
                    <div class="modal-body text-left">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label text-burdeos">Receta:</label>
                                <input class="form-control" placeholder="Nombre" type="text" name="name" autofocus/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ingredients" class="col-form-label text-burdeos">Ingredientes</label>
                                <textarea class="form-control" placeholder="Lista de Ingredientes" rows="5" name="ingredients"></textarea>
                            </div> 

                            <div class="form-group col-md-6">
                                <label for="description" class="col-form-label text-burdeos">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción paso a paso" rows="5" name="description"></textarea>
                            </div>                         
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="video" class="col-form-label text-burdeos">Link de Video:</label>
                                <input class="form-control" placeholder="Link de Video" type="text" name="video">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="image" class="col-form-label text-burdeos">Imágenes:</label>
                                <input class="form-control" placeholder="Imágenes" type="file" name="image[]" multiple>
                            </div>   
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="recipecategory_id" value="{{$category->id}}">                        
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
