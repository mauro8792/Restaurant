@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')

@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
      
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>Nuestro Menú</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Disfrute de nuestro exquisito menú</h2>    
            <p><a href="#section-menu" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>

      </div>
    </section>
    <!-- END section -->
   
    <section class="ftco-section" id="section-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5 mt-5 ftco-animate">
            <h2 class="display-4">Nuestro menú</h2>
            <div class="row justify-content-center">
              <div class="col-md-9">
                <p class="lead">Disponemos de carnes de excelente calidad, cortes argentinos y nacionales para hacer a la barbacoa (huelen que alimentan) y una carta basada en comida mediterránea exquisita.</p>
              </div>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <div class="row">
                <div class="col-4">
                  <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($categories as $category)
                      <?php $showActive=($loop->first)?"active":" ";?>  
                      <a class="list-group-item list-group-item-action {{$showActive}}" id="list-{{$category->id}}-list" data-toggle="list" href="#{{$category->id}}" role="tab" aria-controls="{{$category->name}}">{{$category->name}}</a>
                    @endforeach
                   
                  </div>
                </div>
                <div class="col-8">
                  <div class="tab-content" id="nav-tabContent">
                    @foreach ($categories as $category)
                      <?php $showActive=($loop->first)?"show active":" ";?>  
                        <div class="tab-pane fade {{$showActive}}" id="list-{{$category->id}}" role="tabpanel" aria-labelledby="list-{{$category->name}}-list">
                          <div class="row">
                            @foreach ($category->products as $product)
                            <div class="col-md-4 ftco-animate">   
                              <div class="media menu-item">
                                <div class="media-body">
                                  <h5 class="mt-0">{{$product->name}}</h5>
                                  <p>{{$product->description}}</p>
                                  <h6 class="text-primary menu-price">${{$product->price}}</h6>
                                </div>
                              </div>                          
                            </div>
                            @endforeach
                        </div>
                        </div>
                        
                    @endforeach
                    
                  </div>
                </div>
              </div>
            

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

      
@stop

@section('scripts')

@stop