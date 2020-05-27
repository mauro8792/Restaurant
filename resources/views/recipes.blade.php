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

    <section class="ftco-section" id="section-recipes">
      <div class="container">

        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">Nuestras Recetas </h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
          @foreach ($recipes as $recipe)
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
    </section>
    <!-- END section -->

@stop

@section('scripts')

@stop