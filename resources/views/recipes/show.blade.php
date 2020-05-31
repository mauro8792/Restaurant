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
            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="ftco-section" id="section-menu">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center mb-5 mt-5 ftco-animate">
              <h2 class="display-4">{{$recipe->name}}</h2>
              <div class="row justify-content-center">
                <div class="col-md-9">
                <p class="lead">{{$recipe->short_description}}</p>
                </div>
              </div>
            </div>
  
            <div class="col-md-12 ">
              <div class="row">
                  <div class="col-7 text-left">
                    <div class="list-group" id="list-tab" role="tablist">
                        {!! $recipe->video_big_html !!}
                     
                    </div>
                  </div>
                  <div class="col-5 text-left">
                    <div class="tab-content" id="nav-tabContent">
                        <?php $str = str_replace("*", ' - ', $recipe->ingredients);?>
                        <pre class="text-burdeos "><b>Ingredientes:</b><BR>{{ $str }}</pre>
                    </div>
                  </div>
                </div>
            </div>
            

          </div>

          <div class="col-md-2"></div>
  
          <div class="col-md-5 ftco-animate" data-animate-effect="fadeInRight">
            <?php $str = str_replace("\n", ' - ', $recipe->ingredients);?>
            <pre class="text-burdeos "><b>Ingredientes:</b><BR>{{ $str }}</pre>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 text-left ftco-animate">
            <p class="text-burdeos"><b>Paso a paso:</b><BR>{{ $recipe->description }}</p>                
          </div>
        </div>

      </div>
    </section>
    
@stop

@section('scripts')

@stop

