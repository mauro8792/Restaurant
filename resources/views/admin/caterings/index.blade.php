@extends('layouts.appAdmin')

@section('title', 'Caterings')

@section('body-class', 'caterings-page')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>  
@stop

@section('content')
    <section class="mb-4">
      <div class="container mt-3">

              <div class="div_trans8 corner4 p-3">
                  <div class="text-white">
                      <h2 class="text-center text-white">Listado de Caterings</h2>                  
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
                              <p class="text-center"><a href="#modalCateringAdd" class="btn btn-burdeos btn-round" data-toggle="modal"  data-target="#modalCateringAdd">Nuevo Catering</a></p>
                              <div class="row table-responsive-sm">
                                  <div class="col-md-12">
                                  @if(count($caterings)>0)
                                      <table id="cateringsTable" class="table table-striped text-white">
                                      <thead>
                                          <tr>
                                            <th class="text-center" width="30%">Nombre</th>
                                            <th class="text-center" width="35%">Descripcion</th>
                                            <th class="text-center" width="10%">Precio</th>
                                            <th class="text-center" width="10%">Imagen</th>
                                            <th class="text-center" width="15%">Opciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($caterings as $catering)
                                          <tr>
                                            <td class="text-left" data-toggle="tooltip" title="{{ $catering->name }}">{{ Str::limit($catering->name,35,'...') }}</td>                                            
                                            <td class="text-left" data-toggle="tooltip" data-placement="top" title="{{ $catering->description }}">{{ Str::limit($catering->description,45,'...') }}</td>                                                                                       
                                            <td class="text-right">{{ $catering->price }}</td>                                             
                                            <td class="text-center"><img src="{{ $catering->featured_image_url }}" height="50"></td>
                                            <td class="text-right">
                                                    <a href="#modalCateringDetail{{$catering->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $catering->name }}" data-toggle="modal"  data-target="#modalCateringDetail{{$catering->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                    <a href="#modalCateringEdit{{$catering->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar {{ $catering->name }}" data-toggle="modal"  data-target="#modalCateringEdit{{$catering->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                    <a href="#modalCateringDelete{{$catering->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar {{ $catering->name }}" data-toggle="modal"  data-target="#modalCateringDelete{{$catering->id}}"><i class="fa fa-times t-red"></i></a>
                                            </td>
                                          </tr>

                                          <!-- Modal Catering Detail -->
                                          <div class="modal fade t-black text-center" id="modalCateringDetail{{$catering->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCateringDetail{{$catering->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalCateringDetail{{$catering->id}}Title">Detalle de {{ $catering->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <img src="{{ asset($catering->featured_image_url) }}" alt="Thumbnail Image" class="img-thumbnail">
                                                                </div>
                                                            </div>                                                             
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Catering: {{ $catering->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $catering->description}}</p>
                                                                    <!-- <textarea name="desc" rows="5" readonly="readonly">{{ $catering->description}}</textarea> -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 text-burdeos">
                                                                    <p class="text-burdeos">Precio: <?php echo ($catering->price>0)?"$":"";?>{{ $catering->price}}</p>
                                                                </div>
                                                            </div>                                                            
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-burdeos" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Catering Detail -->

                                          <!-- Modal Catering Edit -->
                                          <div class="modal fade t-black" id="modalCateringEdit{{$catering->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCateringEdit{{$catering->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalCateringEdit{{$catering->id}}Title">Modificar Datos de  {{ $catering->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/caterings/'.$catering->id.'/edit') }}" enctype="multipart/form-data">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                                              <input class="form-control" type="text" name="name" value="{{ $catering->name }}" autofocus/>
                                                          </div>

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="description" class="col-form-label text-burdeos">Descripción:</label>                                
                                                                    <textarea class="form-control" placeholder="Descripción" rows="5" name="description">{{ $catering->description }}</textarea>
                                                                </div>
                                                            </div>  

                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="price" class="col-form-label text-burdeos">Precio:</label>
                                                                    <input class="form-control" type="number" name="price" id="price" value="{{ $catering->price }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="image" class="col-form-label text-burdeos">Imágen: </label>
                                                                    <input class="form-control" type="file" name="image" value="{{ $catering->image }}">
                                                                        @if ($catering->image)
                                                                        <p class="font12">
                                                                            Subir sólo si desea reemplazar la
                                                                            <a href="{{ asset('/images/caterings/'.$catering->image) }}" target="_blank">imagen actual</a>
                                                                        </p>
                                                                        @endif                                                              
                                                                </div>
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
                                          <!-- End Modal Catering Edit -->

                                          <!-- Modal Catering Delete -->
                                          <div class="modal fade t-black text-center" id="modalCateringDelete{{$catering->id}}" tabindex="-1" role="dialog" aria-labelledby="modalCateringDelete{{$catering->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-danger">
                                                          <h5 class="modal-title text-white" id="modalCateringDelete{{$catering->id}}Title">Desea Eliminar la Categoría  {{ $catering->name }}?</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <img src="{{ asset($catering->featured_image_url) }}" alt="Thumbnail Image" class="img-thumbnail">
                                                                </div>
                                                            </div>                                                          
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">{{ $catering->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="text-burdeos">Descripción: {{ $catering->description}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="price" class="col-form-label text-burdeos">Precio: <?php echo ($catering->price>0)?"$":"";?>{{ $catering->price }}</label>
                                                                </div>
                                                            </div>                                                            
                                                      </div>
                                                      <div class="modal-footer">
                                                          <form method="post" action="{{ url('/admin/caterings') }}">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <input type="hidden" name="id" value="{{ $catering->id }}">
                                                              <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cancelar</button>
                                                              <button class="btn btn-outline-danger" type="submit" title="Eliminar la Categoría {{ $catering->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal Catering Delete -->

                                          @endforeach
                                      </tbody>
                                  </table>

                                  @else
                                      <h4 class="text-white">No hay Caterings cargados</h4>
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
 
    
    <!-- Modal Catering Add -->

    <div class="modal fade t-black" id="modalCateringAdd" tabindex="-1" role="dialog" aria-labelledby="modalCateringAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-burdeos">
                    <h5 class="modal-title text-white" id="modalCateringAddTitle">Agregar Catering</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/caterings') }}" enctype="multipart/form-data">
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
                                <label for="description" class="col-form-label text-burdeos">Descripción:</label>                                
                                <textarea class="form-control" placeholder="Descripción" rows="5" name="description"></textarea>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price" class="col-form-label text-burdeos">Precio:</label>
                                <input class="form-control" type="number" name="price" id="price">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="image" class="col-form-label text-burdeos">Imágen:</label>
                                <input class="form-control" type="file" name="image">
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
    <!-- End Modal Catering Add -->    
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>   

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 2000);


        $('#modalCateringAdd').on('shown.bs.modal', function (e) {
            $('#name').focus();
        })

        $(document).ready(function() {
            $('#cateringsTable').DataTable({
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


