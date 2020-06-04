@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/precios.css') }}">
@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
      
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>Nuestra Carta</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Disfrute de nuestro exquisito menú</h2>    
            <p><a href="#section-menu-categories" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>

      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-menu-categories">
      <div class="container">
        <div class="row">       
          <div class="col-md-12 text-center mb-5 mt-5 ftco-animate">
            <h2 class="display-4">Nuestra Carta</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Disfrute de nuestro exquisito menú</p>
              </div>
            </div>
          </div>             
          <div class="col-md-12 text-center">
            <ul class="nav ftco-tab-nav nav-pills mb-5" id="pills-tab" role="tablist">
              @foreach ($categories as $category)
                <li class="nav-item ftco-animate mb-2">
                  <?php $showActive=($loop->first)?"active":" ";?>
                  <?php $showAriaSelected=($loop->first)?"true":"false";?>
                  <a href="#section-menu-category-{{$category->id}}" class="nav-link {{ $showActive }}">{{$category->name}}</a> 
                </li>                  
              @endforeach
            </ul>
          <div class="tab-content text-left">              
        </div>
      </div>
    </section>              
    <!-- END section -->              

    @foreach ($categories as $category)   
    <section class="ftco-section bg-light" id="section-menu-category-{{$category->id}}">
      <div class="container">
        <div class="row">                     
            <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                <h4 class="display-4">{{ $category->name }}</h4>
            </div>
            <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                <img class="mr-3" src="{{ $category->featured_image_url }}" class="img-fluid" alt="Restaurante La Carreta">
            </div>
        </row>       

        <div class="row">
            @foreach ($category->products as $product)
            <div class="col-lg-6 ftco-animate">   
                <p class="p">
                  <span class='descripcion text-burdeos'>{{$product->name}} <span class='descripcion font12'>  {{$product->description}}</span></span>                        
                  <span class='precio text-burdeos'>{{$product->price}}</span>
                </p>                  

            </div>
            @endforeach
        </div>
        <div class="col-md-12 ftco-animate text-center">
              <p class="lead mt-3"><a href="#section-menu-categories" class="btn btn-outline-burdeos btn-lg">Subir</a></p>
        </div>      
      </div>
    </section>                   
    <!-- END section -->    
    @endforeach


    <section class="ftco-section" id="section-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">Nuestro Menú del Día</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Solo de Lunes a Viernes</p>
              </div>
            </div>
          </div>

          <div class="col-md-12 bg-light">
            <div class="item">
              <div class="media d-block mb-3 mt-3 text-center ftco-media ftco-animate border-0">
                <div class="row pt-5 pb-5">
                  <div class="col-md-6">
                    <img src="{{ $menuDelDia->featured_image_url }}" alt="Restaurante La Carreta" class="img-fluid">
                  </div>
                  
                  <div class="col-md-6">
                    <h5 class="mt-0 h4 text-primary">{{$menuDelDia->products[0]->name}}</h5>
                    <h3> €{{$menuDelDia->products[0]->price}}</h3>
                    <p class="mb-4">{{$menuDelDia->products[0]->description}}</p>
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
  <script src="{{ asset ('js/prefixfree.min.js') }}"></script>
@stop