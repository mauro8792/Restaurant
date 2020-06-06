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
            <p><a href="#section-caterings" class="btn btn-outline-white btn-lg ftco-animate">Continuar</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <section class="ftco-section bg-light" id="section-caterings">
      <div class="container">
        
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h4 class="ftco-sub-title">Nuestros Caterings</h4>
            <h2 class="display-4 mb-5">Catering de puño y letra</h2>
            <div class="row justify-content-center">
              <div class="col-md-12">
                <p class="lead">Somos una Empresa de Catering en Málaga. Prestamos servicio a toda Andalucía preparando Carnes a la Brasa, Cócteles de aperitivos, comida casera preparada delante de los comensales.</p>
                <p class="lead">Nuestro servicio de Buffet servido, Cuenta con carnes a la brasa y platos caseros preparados por manos expertas a los fogones. Entrantes como las Empanadas Criollas al horno, Pintxos de Chorizo Criollo y Morcilla, el Matambre arrollado y una gran variedad de ensaladas y verduras.</p>                
                <p class="lead">Gran variedad de Aperitivos: Ensaladilla rusa, Tortilla de patatas, Salmorejo, Flamenquin, Canapés de todo tipo, croquetas caseras de Jamón, de rabo de toro, de choco, milhojas de atún, quiché de verduras</p>
                <p class="lead">Una cocina con mucho mimo y dedicación con la mejor calidad en carnes nacionales y de importación preparadas y asadas delante de los invitados... con un gran atractivo!! Un catering verdaderamente diferente, que sorprende.</p>
                <p class="lead">Catering Asados Argentinos: Cócteles de aperitivos - Menús a su gusto - Recenas - Barra de bebidas - Corderos a la Estaca - Parrillada Vegetales - Paellas gigantes - Postres caseros, Mesas de tartas, Mesas dulces,
                 Decoración infantil, Carro de chuches - Disponemos de mobiliario y menaje para su evento, para hacerle más sencilla la organización de su evento. - Disponemos de servicio de camareros. - Cortador de jamón - Disponemos de servicio de DJ, con conexión a internet - Montaje de escenarios para conciertos - Personal para montajes - Personal para carga y descarga</p> 
              </div>
            </div>
          </div>

          <div class="row d-flex justify-content-center">          
          @foreach ($caterings as $catering)
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="media d-block mb-4 text-center ftco-media ftco-animate">
                <img src="{{ $catering->featured_image_url }}" alt="Restaurante La Carreta" class="img-fluid">
                <div class="media-body p-md-1">
                    <h5 class="mt-0 h4">{{$catering->name}}</h5>
                    <p class="mb-1">{{ Str::limit($catering->description,350,'...') }}</p>
                    <h5 class="text-primary mb-2">{{ ($catering->price>0)?"€":" "}}{{ $catering->price}}</h5>                      
                    <p class="mb-2"><a href="{{ url('/caterings/'.$catering->id)}}" class="btn btn-burdeos btn-sm">Ver Catering</a></p>
                </div>
              </div>
            </div>  
          @endforeach
          </div>
        
        </div>
      </div>
    </section>

@stop

@section('scripts')

@stop