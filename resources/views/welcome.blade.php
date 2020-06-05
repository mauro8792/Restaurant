@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')

@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">

            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>Restaurante La Carreta</h1>

            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Las mejores carnes a la barbacoa</h2>    
            <p><a href="#section-about" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>
      </div> 
    </section>
    <!-- END section -->
    
    <section class="ftco-section" id="section-about">
      <div class="container">
        <div class="row">
          <div class="col-md-5 ftco-animate mb-5">
            <h4 class="ftco-sub-title">Queremos darle la</h4>
            <h2 class="ftco-primary-title display-4">Bienvenida</h2>
            <p>Aquí encontrará un ambiente muy familiar y unos platos para deleitar su paladar.</p>

            <p class="mb-4">Disponemos de carnes de excelente calidad, cortes argentinos y nacionales para hacer a la barbacoa (huelen que alimentan) y una carta basada en comida mediterránea exquisita.</p>
            <p><a href="#section-menu" class="btn btn-outline-burdeos btn-lg">Continuar</a></p>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-5 ftco-animate img " data-animate-effect="fadeInRight">
            <img src="{{ asset('/images/LogoLaCarreta.jpg') }}" width="400">
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
    
    <section class="ftco-section bg-light" id="section-menu">
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
                <li class="nav-item ftco-animate">
                  <?php $showActive=($loop->first)?"active":" ";?>
                  <?php $showAriaSelected=($loop->first)?"true":"false";?>
                  <a class="nav-link {{ $showActive }}" id="pills-{{$category->id}}-tab" data-toggle="pill" href="#pills-{{$category->id}}" role="tab" aria-controls="pills-{{$category->id}}" aria-selected="{{ $showAriaSelected }}">{{$category->name}}</a> 
                </li>                  
              @endforeach
              
            </ul>
              <div class="tab-content text-left">

                @foreach ($categories as $category)       
                <?php $showActive=($loop->first)?"show active":" ";?>                      
                <div class="tab-pane fade {{ $showActive}}" id="pills-{{$category->id}}" role="tabpanel" aria-labelledby="pills-{{$category->id}}-tab">
                  <div class="row">
                    <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                        <img class="mr-3" src="{{ $category->featured_image_url }}" class="img-fluid" alt="Restaurante La Carreta">
                    </div>
                  </div>                      
                  <div class="row">
                      @foreach ($category->products->random(3) as $product)
                      <div class="col-md-4 ftco-animate">   
                        <div class="media menu-item">
                          <div class="media-body">
                            <h5 class="mt-0">{{$product->name}}</h5>
                            <p>{{$product->description}}</p>
                            <h6 class="text-primary menu-price">€{{$product->price}}</h6>
                          </div>
                        </div>                          
                      </div>
                      @endforeach
                  </div>
                </div>
                @endforeach
               </div>
               <div class="col-md-12 d-flex justify-content-center ftco-animate">
                <p class="lead"><a href="/menu" class="btn btn-outline-burdeos btn-lg">Vea Nuestra Carta Completa</a></p>
              </div>
          </div>
      </div>
    </section>
    <!-- END section -->
  
    <section class="ftco-section" id="section-daymenu">
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
              <div class="media d-block text-center ftco-media ftco-animate border-0">
                <div class="row mb-5">
                  <div class="col-md-12">
                    <img src="{{ $menu->featured_image_url }}" alt="Restaurante La Carreta" class="img-fluid">
                  </div>
                
                </div>
              </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center ftco-animate">
                <p class="lead"><a href="/menu" class="btn btn-outline-burdeos btn-lg">Vea Nuestro Menú Completo</a></p>
              </div>            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-gallery">
      <div class="container">
        <div class="row ftco-custom-gutters">

          <div class="col-md-12 text-center mb-1 ftco-animate">
            <h2 class="display-4">Galería de Fotos</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
              <!--  <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
              </div>
            </div>
          </div>

          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/01.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/01.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>           
          <div class="col-md-4 ftco-animate">          
            <a href="{{asset('images/principal/02.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/02.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/03.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/03.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/04.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/04.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/05.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/05.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/06.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/06.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>                                                 
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/07.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/06.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>   
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/08.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/08.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>   
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/09.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/09.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>             
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/10.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/10.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>  
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/11.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/11.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>  
          <div class="col-md-4 ftco-animate">
            <a href="{{asset('images/principal/12.jpg')}}" class="ftco-thumbnail image-popup">
              <img src="{{asset('images/principal/12.jpg')}}" alt="Restaurant Barbacoa La Carreta" class="img-fluid">
            </a>
          </div>                                
        </div>        
      </div>
    </section>
    <!-- END section -->


    <section class="ftco-section" id="section-catering">
      <div class="container">
        
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h4 class="ftco-sub-title">Gauchito Catering</h4>
            <h2 class="display-4">Catering de puño y letra</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Somos una Empresa de Catering en Málaga. Prestamos servicio a toda Andalucía preparando Carnes a la Brasa, Cócteles de aperitivos, comida casera preparada delante de los comensales.</p>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row d-flex justify-content-center">
              @foreach ($caterings as $catering)
                <div class="col-md-4">
                  <div class="media d-block mb-4 text-center ftco-media ftco-animate border-0">
                    <img src="{{ $catering->featured_image_url }}" alt="Restaurante La Carreta" class="img-fluid">
                    <div class="media-body p-md-5 ">
                      <h5 class="mt-0 h4">{{$catering->name}}</h5>
                      <p class="mb-1 pPreLine">{{$catering->description}}</p>
                      <h5 class="text-primary mb-2">{{ ($catering->price>0)?"€".$catering->price:" "}}</h5>                      
                      <p class="mb-2"><a href="{{ url('/caterings/'.$catering->id)}}" class="btn btn-burdeos btn-sm">Ver Catering</a></p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

              <div class="col-md-12 d-flex justify-content-center ftco-animate">
                <p class="lead"><a href="{{ url('/caterings')}}" class="btn btn-outline-burdeos btn-lg">Vea Nuestros Caterings</a></p>
              </div>
        
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-contact">
      <div class="container">
        <div class="row">

          <div class="col-md-12 text-center mb-3 ftco-animate">
            <h2 class="display-4">Contáctenos</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
               <!-- <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
              </div>
            </div>
          </div>

          <div class="col-md mb-1 ftco-animate">
            <form method="POST" action="{{ route('contact') }}">
              {{ csrf_field() }}    
              <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese Su Nombre">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese su Dirección de Correo Electrónico">
              </div>
              <div class="form-group">
                <label for="message" class="sr-only">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Escriba su Mensaje"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-outline-burdeos btn-lg" value="Enviar">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>
    <!-- END section -->     
 
    <section class="ftco-section" id="section-map">
      <div class="container">
        <div class="row">

          <div class="col-md-12 text-center mb-0 ftco-animate">
            <h2 class="display-4 mb-4">Visítenos</h2>
            <div class="row justify-content-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d476.5234595042515!2d-4.643653185164404!3d36.53831801189226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72e34d0a0ef303%3A0x237e23eba6eb396d!2sRestaurante%20Grill%20la%20Carreta!5e0!3m2!1ses-419!2sar!4v1590699871324!5m2!1ses-419!2sar" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- END section -->     

    

@stop

@section('scripts')

@stop