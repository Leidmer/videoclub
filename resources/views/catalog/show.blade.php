@extends('layouts.master')

@section('content')


<div class="card mb-3" style="max-width: 1200px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img width="300" src="{{$pelicula->poster}}">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{$pelicula->title}}</h5>
        <p class="card-text">Año: {{$pelicula->year}}</p>
        <p class="card-text">Director: {{$pelicula->director}}</p>
        <p class="card-text">Resumen: {{$pelicula->synopsis}}</p>
        <p class="card-text">Estado: {{$pelicula->rented}}</p>

        @if ($pelicula->favourite )
                <p><b>Estat:</b> Pel·lícula afegida a favorits</p>
                <form action="{{action('CatalogController@putNotFavourite', $pelicula->id)}}"  method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                        Treure de favorits
                    </button>
                </form>
            @else
                <form action="{{action('CatalogController@putFavourite', $pelicula->id)}}"  method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Afegir a favorits
                    </button>
                </form>
            @endif



        @if ($pelicula->rented )
                <p><b>Estat:</b> Pel·lícula actualment llogada.</p>
                <form action="{{action('CatalogController@putReturn', $pelicula->id)}}"  method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info">
                        Retornar pel·lícula
                    </button>
                </form>
            @else
                <form action="{{action('CatalogController@putRent', $pelicula->id)}}"  method="POST" style="display:inline">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info">
                        <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Llogar pel·lícula
                    </button>
                </form>
            @endif
            <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}"  method="POST" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar pel·lícula 
                </button>
            </form>
        <a class="btn btn-warning" href="{{ url('/catalog/edit/'.$pelicula->id )}}" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true">Editar película</span></a>
        <a class="btn btn-outline-dark" href="{{url('/catalog')}}" role="button"><span class="glyphicon glyphicon-chevron-left">Volver al listado</span></a>
    
                      <div class="container">
                <div style="margin-right:0px; margin-left:0px; margin-top: 30px;"">
                  <h2>Comentaris |2| <div class="pull-right"> </div></h2>
                </div>
                <div  id="addcomment" style="display: none; margin-right:0px; margin-left:0px;">
                    <form>
                        <textarea class="form-control" placeholder="Comment content..."></textarea><br/>
                        <button class="btn btn-primary">Send</button>
                    </form>
                </div>
                <hr>
                <div style="margin-right:20px; margin-left:20px;margin-bottom:30px;">
                    <div style="margin-bottom:10px;">
                        <small><strong style="margin-right:30px;">Diablo25</strong> 30.10.2017 12:13</small>
                    </div>    
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin non lorem elementum, accumsan magna sed, faucibus mauris. Nulla pellentesque ante nibh, ac hendrerit ante fermentum sed. Nunc in libero dictum, porta nibh pellentesque, ultrices dolor. Curabitur nunc ipsum, blandit vel aliquam id, aliquam vel velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed sit amet mi dignissim, pretium justo non, lacinia libero. Nulla facilisi. Donec id sem velit. </p>
                </div>
                <div style="margin-right:20px; margin-left:20px;margin-bottom:30px;">
                    <div style="margin-bottom:10px;">
                        <small><strong style="margin-right:30px;">Giesche</strong> 30.10.2017 12:13</small>
                    </div>    
                    <p>Praesent molestie ante nec metus convallis aliquam. Ut aliquam tincidunt mollis. Maecenas et ex sit amet est vehicula ultrices sed sit amet elit. Suspendisse potenti. Aenean et quam ut purus convallis porttitor. Mauris porttitor pretium elementum. Duis blandit elit tincidunt ipsum ultricies, ut faucibus lorem facilisis. Proin ipsum turpis, pharetra in lorem ac, porta ullamcorper velit. Proin gravida odio eget elit ultricies sodales. Vivamus vel tincidunt ligula. Proin pulvinar pellentesque velit eget luctus. Aliquam vitae enim ut purus vestibulum sollicitudin sit amet eget lacus. Nunc tempus fringilla tincidunt. </p>
                </div>
                <hr>
              </div>
        <form>
              <div class="form-group">
                <label for="enviacomentari">Enviar comentari:</label>
                <input type="text" class="form-control" id="resumcomentari" placeholder="Resum del comentari">
              </div>
              <div class="form-group">
                <label for="valoracio">Valoració:</label>
                <select class="form-control" id="valoracio">
                  <option>1 estrella</option>
                  <option>2 estrelles</option>
                  <option>3 estrelles</option>
                  <option>4 estrelles</option>
                  <option>5 estrelles</option>
                </select>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="comentari" rows="3" placeholder="Dona'ns la teva opinió"></textarea>
              </div>
              <button type="submit" class="btn btn-success">Valorar</button>
              </form>
      </div>
    </div>
  </div>

    {{-- TODO: Imagen de la película --}}

@stop