@extends('layouts.master')
@section('content')

    <div class="row">

    <div class="col-xs-6 col-sm-4 col-md-3 text-center">

        <a href="{{ url('/category/create'}}"><button type="submit" class="btn-success">Afegir categoria</button></a>


    
    </div>
        @foreach( App\Category::all() as $categoria )

        {{$categoria->id}}
        {{$categoria->title}}
        {{$categoria->desciption}}
        {{$(categoria->adult)?'Si':'No'}}
    
        <a href="{{url('/category/'.$categoria->id)}}"><button type="button" class="btn" style="background-color: #611BBD; color: white">Mostrar</button></a>
          <a href="{{url('/category/'.$categoria->id.'/edit')}}"><button type="button" class="btn btn-warning">Editar</button></a>
          <form action="{{action('CategoryController@destroy', $categoria->id)}}" method="post" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        @endforeach

    </div>
@stop
