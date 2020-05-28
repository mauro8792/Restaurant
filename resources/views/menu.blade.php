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
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Las mejores carnes del país</h2>    
            <p><a href="#section-menu" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>

      </div>
    </section>
    <!-- END section -->
   
    <section class="ftco-section bg-light" id="section-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5 mt-5 ftco-animate">
            <h2 class="display-4">Nuestro menú</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>

          <div class="col-md-12 text-center">

            <ul class="nav ftco-tab-nav nav-pills mb-5" id="pills-tab" role="tablist">
              <li class="nav-item ftco-animate">
                <a class="nav-link active" id="pills-breakfast-tab" data-toggle="pill" href="#pills-breakfast" role="tab" aria-controls="pills-breakfast" aria-selected="true">Desayuno</a>
              </li>
              <li class="nav-item ftco-animate">
                <a class="nav-link" id="pills-lunch-tab" data-toggle="pill" href="#pills-lunch" role="tab" aria-controls="pills-lunch" aria-selected="false">Carnes</a>
              </li>
              <li class="nav-item ftco-animate">
                <a class="nav-link" id="pills-dinner-tab" data-toggle="pill" href="#pills-dinner" role="tab" aria-controls="pills-dinner" aria-selected="false">Ibéricos</a>
              </li>
            </ul>

            <div class="tab-content text-left">

              <div class="tab-pane fade show active" id="pills-breakfast" role="tabpanel" aria-labelledby="pills-breakfast-tab">
                <div class="row">
                  <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                          <img class="mr-3" src="images/menu_1.jpg" class="img-fluid" alt="Free Template by Free-Template.co">
                  </div>
                </div>
                <div class="row text-center">               
                    @foreach ($breakfasts as $breakfast)
                      <div class="col-md-4 ftco-animate media menu-item">
                        <div class="media-body">
                          <h5 class="mt-0">{{$breakfast->name}}</h5>
                          <p>{{$breakfast->description}}</p>
                          <h6 class="text-primary menu-price">€{{$breakfast->price}}</h6>
                        </div>
                      </div>
                    @endforeach
                </div>
              </div>

              <div class="tab-pane fade" id="pills-lunch" role="tabpanel" aria-labelledby="pills-lunch-tab">
                <div class="row">
                  <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                          <img class="mr-3" src="images/menu_1.jpg" class="img-fluid" alt="Free Template by Free-Template.co">
                  </div>
                </div>
                <div class="row text-center">
                    @foreach ($meets as $meet)
                      <div class="col-md-4 ftco-animate media menu-item">
                        <div class="media-body">
                          <h5 class="mt-0">{{$meet->name}}</h5>
                          <p>{{$meet->description}}</p>
                          <h6 class="text-primary menu-price">€{{$meet->price}}</h6>
                        </div>
                      </div>
                    @endforeach
                </div>
              </div>
              
              <div class="tab-pane fade" id="pills-dinner" role="tabpanel" aria-labelledby="pills-dinner-tab">
                <div class="row">
                  <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                          <img class="mr-3" src="images/menu_1.jpg" class="img-fluid" alt="Free Template by Free-Template.co">
                  </div>
                </div>              
                <div class="row text-center">
                    @foreach ($ibericos as $iberico)
                      <div class="col-md-4 ftco-animate media menu-item">
                        <div class="media-body">
                          <h5 class="mt-0">{{$iberico->name}}</h5>
                          <p>{{$iberico->description}}</p>
                          <h6 class="text-primary menu-price">€{{$iberico->price}}</h6>
                        </div>
                      </div>                        
                    @endforeach
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

      
    <section class="ftco-section bg-light" id="section-menu">
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

          <div class="col-md-12 ">
            <div class="item">
              <div class="media d-block mb-4 text-center ftco-media ftco-animate border-0">
                <div class="row pt-5 pb-5">
                  <div class="col-md-6">
                    <img src="{{ $menu->featured_image_url }}" alt="Free Template by Free-Template.co" class="img-fluid">
                  </div>
                  
                  <div class="col-md-6">
                    <h5 class="mt-0 h4 text-primary">{{$menu->products[0]->name}}</h5>
                    <h3> €{{$menu->products[0]->price}}</h3>
                    <p class="mb-4">{{$menu->products[0]->description}}</p>
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