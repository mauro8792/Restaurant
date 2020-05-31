@extends('layouts.appGuest')

@section('title', 'La Carreta')

@section('styles')


@stop
<style>
  /*!
 * Start Bootstrap - Simple Sidebar (https://startbootstrap.com/template-overviews/simple-sidebar)
 * Copyright 2013-2019 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-simple-sidebar/blob/master/LICENSE)
 */
body {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}

</style>
@section('content')
    <section class="ftco-cover" style="background-image: url({{ asset('/images/bg_3.jpg') }});" id="section-home">
      <div class="container">
      
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
          <div class="col-md-12">
            <h1 class="ftco-heading ftco-animate text-left mb-3">La carreta Restaurante</h1>
            <h2 class="h5 ftco-subheading mb-5 ftco-animate text-left">Disfrute de nuestro exquisito menú</h2>    
            <p class=" ftco-animate text-left">Disponemos de carnes de excelente calidad, cortes argentinos y nacionales para hacer a la barbacoa (huelen que alimentan) y una carta basada en comida mediterránea exquisita.</p>
          </div>
        </div>

      </div>
    </section>
    <!-- END section -->
    
    <section class="ftco-section bg-light" id="section-menu">
      <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="sidebar-heading">Menú </div>
          <div class="list-group list-group-flush ftco-tab-nav nav-pills" id="pills-tab" role="tablist">
            @foreach ($categories as $category)
              <?php $showActive=($loop->first)?"active":" ";?>
              <?php $showAriaSelected=($loop->first)?"true":"false";?>
              <a class="list-group-item list-group-item-action bg-light" id="pills-{{$category->id}}-tab" data-toggle="pill" href="#pills-{{$category->id}}" 
              role="tab" aria-controls="pills-{{$category->id}}" aria-selected="{{ $showAriaSelected }}">{{$category->name}}</a>
                
            @endforeach
            
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
    
        <!-- Page Content -->

        <div class="tab-content text-left ml-3">
            @foreach ($categories as $category)       
                  <?php $showActive=($loop->first)?"show active":" ";?>                      
                  <div class="tab-pane fade {{ $showActive}}" id="pills-{{$category->id}}" role="tabpanel" aria-labelledby="pills-{{$category->id}}-tab">              
                    <div class="row">
                      <div class="col-md-12 ftco-animate media menu-item d-flex justify-content-center">
                          <img class="mr-3" src="{{ $category->featured_image_url }}" class="img-fluid" alt="Restaurante La Carreta">
                      </div>
                    </div>                      
                    <div class="row">
                        @foreach ($category->products as $product)
                        <div class="col-md-4 ftco-animate" id="pills-{{$category->id}}">   
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

        <!-- /#page-content-wrapper -->
    
      </div>
    </section>
   


  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

    
@stop

@section('scripts')
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop