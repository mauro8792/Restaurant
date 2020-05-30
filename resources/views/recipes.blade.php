@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')

@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>Nuestras Recetas</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left"></h2>    
            <p><a href="#section-recipes" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-recipes">
      <div class="container">

        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">Nuestras Recetas </h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Prepare nuestras recetas favoritas.</p>
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center">      

            <ul class="nav ftco-tab-nav nav-pills mb-5" id="pills-tab" role="tablist">
                @foreach ($categories as $category)
                  <li class="nav-item ftco-animate mb-3">
                    <?php $showActive=($loop->first)?"active":" ";?>
                    <?php $showAriaSelected=($loop->first)?"true":"false";?>
                    <a class="nav-link {{ $showActive }}" id="pills-{{$category->id}}-tab" data-toggle="pill" href="#pills-{{$category->id}}" role="tab" aria-controls="pills-{{$category->id}}" aria-selected="{{ $showAriaSelected }}">{{$category->name}}</a> 
                  </li>                  
                @endforeach    
            </ul>
            <div class="tab-content">

              @foreach ($categories as $category)       
              <?php $showActive=($loop->first)?"show active":" ";?>                      
              <div class="tab-pane fade {{ $showActive }}" id="pills-{{$category->id}}" role="tabpanel" aria-labelledby="pills-{{$category->id}}-tab">
                <div class="row">
                  <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                      <img class="mr-3" src="{{ $category->featured_image_url }}" class="img-fluid" alt="Restaurante La Carreta">
                  </div>
                </div>                      
                
                <div class="row d-flex justify-content-center">
                  @foreach ($category->recipes as $recipe)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                      <div class="media d-block mb-4 text-center ftco-media ftco-animate">
                        <div class="p-md-1">                
                          {!! $recipe->video_html !!}
                        </div>
                        <div class="media-body p-md-1">
                          <h5 class="mt-0 h4">{{$recipe->name}}</h5>
                          <p class="mt-4 mb-4"><a href="#" class="btn btn-burdeos btn-sm">Ver Receta</a></p>
                        </div>
                      </div>
                    </div>  
                  @endforeach
                </div>
              </div>                
                @endforeach
        </div>
      </div>
    </section>
    <!-- END section -->
    
@stop

@section('scripts')

@stop

