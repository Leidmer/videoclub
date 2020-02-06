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
        <p style="font-size: 2em; margin-top: 30px;">Comentaris</p>
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