@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')

@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">

            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>Gauchito Catering</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Hacemos Catering de puño y letra</h2>    

            <p><a href="#section-catering" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-catering">
      <div class="container">
      
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">{{$catering->name}}</h2>                   
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 ftco-animate mb-5">
            <img src="{{ $catering->featured_image_url }}" alt="Restaurante La Carreta" class="img-fluid">
          </div>

          <div class="col-md-2"></div>
  
          <div class="col-md-5 ftco-animate" data-animate-effect="fadeInRight">
            <p class="lead">{{$catering->description}}</p> 
            <h5 class="text-primary mb-2">{{ ($catering->price>0)?"€":" "}}{{ $catering->price}}</h5>              
          </div>
        </div>

      </div>
    </section>
    
@stop

@section('scripts')

@stop

