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
    
        <!--RESULTAT COMENTARI-->
        @foreach($Reviews as $Review)
                      <div class="container">
                <div style="margin-right:0px; margin-left:0px; margin-top: 30px;">
                  <h2>Comentaris<div class="pull-right"> </div></h2>
                  
                </div>
                <hr>
                <div style="margin-right:20px; margin-left:20px;margin-bottom:30px;">
                    <div style="margin-bottom:10px;">
                        <p>{{$Review->title}}</p>
                        <p>{{$Review->stars}}</p>
                        <small><strong style="margin-right:30px;">{{$Review->user->name}}</strong> {{date('d/m/Y', strtotime($Review->created_at))}}</small>
                    </div>    
                    <p>{{$Review->review}}</p>
                </div>
                <hr>
              </div>

        @endforeach
       

        <!--Formulari enviar comentari-->
        <form method="POST" action="{{action('CatalogController@postReview', $pelicula->id)}}">
        {{ method_field('POST') }}
        {{ csrf_field() }}
              <div class="form-group">
                <label for="enviacomentari">Enviar comentari:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Resum del comentari">
              </div>
              <div class="form-group">
                <label for="valoracio">Valoració:</label>
                <select class="form-control" id="stars" name="stars">
                  <option value="1">1 estrella</option>
                  <option value="2">2 estrelles</option>
                  <option value="3">3 estrelles</option>
                  <option value="4">4 estrelles</option>
                  <option value="5">5 estrelles</option>
                </select>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="review" name="review" rows="3" placeholder="Dona'ns la teva opinió"></textarea>
              </div>
              <button type="submit" class="btn btn-success">Valorar</button>
          </form>
      </div>
    </div>
  </div>

    {{-- TODO: Imagen de la película --}}

@stop