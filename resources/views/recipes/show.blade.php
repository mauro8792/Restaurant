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
            <p><a href="#section-recipe" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="ftco-section bg-light" id="section-recipe">
      <div class="container">
        <div class="row">
              <div class="col-md-12 text-center mb-5 ftco-animate">
                <h2 class="display-4">{{$recipe->name}}</h2>  
                <p class="lead">{{$recipe->short_description}}</p>                                 
              </div>
            </div>


        <div class="row">
          <div class="col-md-5 ftco-animate mb-5">
            {!! $recipe->video_big_html !!}
          </div>

          <div class="col-md-2"></div>
  
          <div class="col-md-5 ftco-animate" data-animate-effect="fadeInRight">
              <?php $str = str_replace("*", ' - ', $recipe->ingredients);?>

              <pre class="text-burdeos "><b>Ingredientes:</b><BR>{{ $str }}</pre>      
          </div>
        </div>

        <div class="row">
              <div class="col-md-12 text-left mb-5 ftco-animate">
                  <p class="text-burdeos"><b>Paso a paso:</b><BR>{{ $recipe->description }}</p>                               
              </div>

        </div>


      </div>
    </section>
    
@stop

@section('scripts')

@stop
