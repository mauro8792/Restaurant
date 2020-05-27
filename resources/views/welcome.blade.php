@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')

@stop

@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
            <h1 class="ftco-heading ftco-animate text-left mb-3">Bienvenido a <BR>La Carreta Restaurante</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Las mejores carnes del país</h2>    
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
            <h4 class="ftco-sub-title">Our Story</h4>
            <h2 class="ftco-primary-title display-4">Welcome</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>

            <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            <p><a href="#" class="btn btn-secondary btn-lg">Our Story</a></p>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-6 ftco-animate img" data-animate-effect="fadeInRight">
            <img src="images/about_img_1.jpg" alt="Free Template by Free-Template.co">
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
              @foreach ($categories as $category)
                <li class="nav-item ftco-animate">
                  <a @if ($loop->first)
                      class="nav-link active"
                  @else
                  class="nav-link"
                  @endif   id="pills-{{$category->name}}-tab" data-toggle="pill" href="#pills-{{$category->name}}" role="tab" aria-controls="pills-{{$category->name}}" aria-selected="true">{{$category->name}}</a>
                </li>                  
              @endforeach
              
            </ul>
              <div class="tab-content text-left">
                <div class="tab-pane fade show active" id="pills-{{$categories[0]->name}}" role="tabpanel" aria-labelledby="pills-{{$categories[0]->name}}-tab">
                  <div class="row">
                    <div class="col-md-6 ftco-animate">
                      @foreach ($categories[0]->products->random(3) as $product)
                        <div class="media menu-item">
                          <img class="mr-3" src="images/menu_1.jpg" class="img-fluid" alt="Free Template by Free-Template.co">
                          <div class="media-body">
                            <h5 class="mt-0">{{$product->name}}</h5>
                            <p>{{$product->description}}</p>
                            <h6 class="text-primary menu-price">${{$product->price}}</h6>
                          </div>
                        </div>
                      @endforeach 
                    </div>                      
                  </div>
                </div> 
                @foreach ($categories->filter(function($kvalue,$key){return $key>0;}) as $category)
                <div class="tab-pane fade " id="pills-{{$category->name}}" role="tabpanel" aria-labelledby="pills-{{$category->name}}-tab">
                  <div class="row">
                    <div class="col-md-6 ftco-animate">
                      @foreach ($category->products->random(3) as $product)
                        <div class="media menu-item">
                          <img class="mr-3" src="images/menu_3.jpg" class="img-fluid" alt="Free Template by Free-Template.co">
                          <div class="media-body">
                            <h5 class="mt-0">{{$product->name}}</h5>
                            <p>{{$product->description}}</p>
                            <h6 class="text-primary menu-price">${{$product->price}}</h6>
                          </div>
                        </div>                          
                      @endforeach
                    </div>
                  </div>
                </div>
                @endforeach
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
                  {!! $recipe->video_html !!}           
                <div class="media-body">
                  <h5 class="mt-0 h4">{{$recipe->name}}</h5>
                  <p class="mb-4">{{$recipe->ingredients}}</p>
                  <p class="mb-0"><a href="#" class="btn btn-burdeos btn-sm">Ver Receta</a></p>
                </div>
              </div>
            </div>  
          @endforeach
          <div class="row justify-content-center media-body ftco-media ftco-animate">
            <p class="mb-0"><a href="{{ url('/recetas') }}" class="btn btn-burdeos btn-lg">Ver Todas</a></p>
        </div>             
        </div>
     
      </div>
    </section>
    <!-- END section -->
    
    <section class="ftco-section bg-light" id="section-daymenu">
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

    <section class="ftco-section" id="section-gallery">
      <div class="container">
        <div class="row ftco-custom-gutters">

          <div class="col-md-12 text-center mb-1 ftco-animate">
            <h2 class="display-4">Food Gallery</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>

          <div class="col-md-4 ftco-animate">
            <a href="images/menu_1.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_1.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="images/menu_2.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_2.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="images/menu_3.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_3.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>

          <div class="col-md-4 ftco-animate">
            <a href="images/menu_2.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_2.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="images/menu_3.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_3.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>
          <div class="col-md-4 ftco-animate">
            <a href="images/menu_1.jpg" class="ftco-thumbnail image-popup">
              <img src="images/menu_1.jpg" alt="Free Template by Free-Template.co" class="img-fluid">
            </a>
          </div>

        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="ftco-section bg-light" id="section-catering">
      <div class="container">
        
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h4 class="ftco-sub-title">Nuestros Caterings</h4>
            <h2 class="display-4">Caterings &amp; Servicios</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">hola mauro far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="owl-carousel ftco-owl">
              @foreach ($caterings as $catering)
                  
                <div class="item">
                  <div class="media d-block mb-4 text-center ftco-media ftco-animate border-0">
                    <img src="{{ $catering->featured_image_url }}" alt="Free Template by Free-Template.co" class="img-fluid">
                    <div class="media-body p-md-5 p-4">
                    <h5 class="text-primary">{{$catering->price ? $catering->price : "0"}}</h5>
                      <h5 class="mt-0 h4">{{$catering->name}}</h5>
                    <p class="mb-4">{{$catering->description}}</p>

                      <p class="mb-0"><a href="#" class="btn btn-primary btn-sm">Order Now!</a></p>
                    </div>
                  </div>
                </div>
              @endforeach

              
              

            </div>
          </div>
          
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section " id="section-contact">
      <div class="container">
        <div class="row">

          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">Contáctenos</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              </div>
            </div>
          </div>

          <div class="col-md mb-5 ftco-animate">
            <form action="" method="post">
              <div class="form-group">
                <label for="name" class="sr-only">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Ingrese Su Nombre">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Ingrese su Dirección de Correo Electrónico">
              </div>
              <div class="form-group">
                <label for="message" class="sr-only">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Escriba su Mensaje"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg" value="Enviar">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </section>
    <!-- END section -->     
 
@stop

@section('scripts')

@stop