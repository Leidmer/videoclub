@extends('layouts.master')

@section('content')


<div class="card mb-3" style="max-width: 900px;">
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
      </div>
    </div>
  </div>

    {{-- TODO: Imagen de la película --}}

@stop