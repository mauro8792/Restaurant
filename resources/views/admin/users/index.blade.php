@extends('layouts.appAdmin')

@section('title', 'Usuarios')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.css"/>    
@stop

@section('content')
    <section class="mb-4">
      <div class="container mt-3">

              <div class="div_trans8 corner4 p-3">
                  <div class="text-white">
                      <h2 class="text-center text-white">Listado de Usuarios</h2>
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
                              <p class="text-center"><a href="#modalUserAdd" class="btn btn-burdeos btn-round" data-toggle="modal"  data-target="#modalUserAdd">Nuevo Usuario</a></p>
                              <div class="row table-responsive-sm">
                                  <div class="col-md-12">
                                  @if(count($users)>0)
                                      <table id="usersTable" class="table table-striped text-white">
                                      <thead>
                                          <tr>
                                              <th class="text-center" width="40%">Nombre</th>
                                              <th class="text-center" width="40%">E-Mail</th>
                                              <th class="text-center" width="20%">Opciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($users as $user)
                                          <tr>
                                              <td class="text-left">{{ $user->name }}</td>
                                              <td class="text-left">{{ $user->email }}</td>
                                              <td class="text-center">
                                                      <input type="hidden" name="id" value="{{ $user->id }}">
                                                      <a href="#modalUserDetail{{$user->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Detalle de {{ $user->name }}" data-toggle="modal"  data-target="#modalUserDetail{{$user->id}}">&nbsp;<i class="fa fa-info t-yellow">&nbsp;</i></a>
                                                      <a href="#modalUserEdit{{$user->id}}" class="btn btn-outline-dark btn-sm" type="button" title="Editar {{ $user->name }}" data-toggle="modal"  data-target="#modalUserEdit{{$user->id}}"><i class="fa fa-edit t-blue"></i></a>
                                                      <a href="#modalUserDelete{{$user->id}}" class="btn btn-outline-dark btn-sm" type="submit" title="Eliminar {{ $user->name }}" data-toggle="modal"  data-target="#modalUserDelete{{$user->id}}"><i class="fa fa-times t-red"></i></a>
                                              </td>
                                          </tr>

                                          <!-- Modal User Detail -->
                                          <div class="modal fade t-black text-center" id="modalUserDetail{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalUserDetail{{$user->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalUserDetail{{$user->id}}Title">Detalle de {{ $user->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                          <div class="row">
                                                              <div class="col-md-12 text-burdeos">
                                                                  <p class="text-burdeos">{{ $user->name}}</p>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <p class="text-burdeos">E-Mail: {{ $user->email}}</p>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-burdeos" data-dismiss="modal">Cerrar</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal User Detail -->

                                          <!-- Modal User Edit -->
                                          <div class="modal fade t-black" id="modalUserEdit{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalUserEdit{{$user->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header bg-burdeos">
                                                          <h5 class="modal-title text-white" id="modalUserEdit{{$user->id}}Title">Modificar Datos de  {{ $user->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <form method="post" action="{{ url('/admin/users/edit') }}">
                                                      <div class="modal-body text-left">
                                                          {{ csrf_field() }}
                                                          <input type="hidden" name="id" value="{{ $user->id }}">

                                                          <div class="form-group">
                                                              <label for="name" class="col-form-label text-burdeos">Nombre:</label>
                                                              <input class="form-control" type="text" name="name" value="{{ $user->name }}" autofocus/>
                                                          </div>
                                                          <div class="form-group">
                                                              <label for="email" class="col-form-label text-burdeos">E-Mail:</label>
                                                              <input class="form-control" type="text" name="email" value="{{ $user->email }}">
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
                                          <!-- End Modal User Edit -->

                                          <!-- Modal User Delete -->
                                          <div class="modal fade t-black text-center" id="modalUserDelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalUserDelete{{$user->id}}Title" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header text-center bg-danger">
                                                          <h5 class="modal-title text-white" id="modalUserDelete{{$user->id}}Title">Desea Eliminar el Usuario  {{ $user->name }}</h5>
                                                          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                      </div>
                                                      <div class="modal-body text-left">
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <p class="text-burdeos">{{ $user->name}}</p>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-md-12">
                                                                  <p class="text-burdeos">E-Mail: {{ $user->email}}</p>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <form method="post" action="{{ url('/admin/users') }}">
                                                              {{ csrf_field() }}
                                                              {{ method_field('DELETE') }}
                                                              <input type="hidden" name="id" value="{{ $user->id }}">
                                                              <button type="button" class="btn btn-outline-burdeos" data-dismiss="modal">Cancelar</button>
                                                              <button class="btn btn-outline-danger" type="submit" title="Eliminar el Usuario {{ $user->name }}"><i class="fa fa-times"></i> Eliminar</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- End Modal User Delete -->

                                          @endforeach
                                      </tbody>
                                  </table>
                                  @else
                                      <h4>No hay usuarios cargados</h4>
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
 
    <!-- Modal User Add -->
    <div class="modal fade t-black" id="modalUserAdd" tabindex="-1" role="dialog" aria-labelledby="modalUserAddTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-burdeos">
                    <h5 class="modal-title text-white" id="modalUserAddTitle">Agregar Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="{{ url('/admin/users/add') }}">
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
                                <label for="email" class="col-form-label text-burdeos">Correo Electrónico:</label>
                                <input class="form-control" type="text" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label text-burdeos">Contraseña:</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="col-form-label text-burdeos">Repita la Contraseña:</label>
                                <input class="form-control" type="password" name="password_confirmation" required>
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
    <!-- End Modal User Add -->        
 
@stop

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.20/datatables.min.js"></script>    

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 2000);


        $('#modalUserAdd').on('shown.bs.modal', function (e) {
            $('#name').focus();
        })

        $(document).ready(function() {
            $('#usersTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrando _MENU_",
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
                "bJQueryUI":		true,
                "aoColumns":[
                    {"bSortable": true},
                    {"bSortable": true},
                    {"bSortable": false, 'searchable': false}
                ],

            });
            $("input.form-control.form-control-sm").attr('placeholder', 'Buscar...');
            $("input.form-control.form-control-sm").attr('size', 30);
            $("input.form-control.form-control-sm").focus();
            $("ul.pagination").addClass("pagination-sm");
        } );
    </script>
@stop


