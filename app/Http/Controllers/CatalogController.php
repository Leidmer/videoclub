<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Review;
use Notify;

class CatalogController extends Controller
{
    public function getIndex()
    {
        return view('catalog.index',
            array(
                'arrayPeliculas' => Movie::all()
            )
        );
    }

    public function getShow($id)
    {  
        $pelicula = Movie::findOrFail($id);

        return view('catalog.show', array(
            'pelicula' => $pelicula
        ));
    }

    public function getCreate()
    {

        return view('catalog.create');
    }

    public function postCreate(Request $request)
    {
        $movie = new Movie;
        
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->director = $request->director;
        $movie->poster = $request->poster;
        $movie->synopsis = $request->synopsis;
        
        $movie->save();
        Notify::success('La película se ha guardado/modificado correctamente'); 
        return redirect()->back();
    }


    
    public function getEdit($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.edit', array(
            'pelicula' => $pelicula
        ));
    }

    public function putEdit(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->director = $request->director;
        $movie->poster = $request->poster;
        $movie->synopsis = $request->synopsis;
        $movie->category_id = $request->category_id;
        
        $movie->save();
        Notify::success('La película se ha guardado/modificado correctamente'); 
        return redirect('catalog/show/'.$id);
        

    }

    public function putRent($id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->rented = true;
        $movie->save();
        
        Notify::success('Pel·lícula llogada!');
        return redirect()->back();
        
    }

    public function putFavourite($id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->favourite = true;
        $movie->save();
        
        Notify::success('Pel·lícula afegida a favorits');
        return redirect()->back();
        
    }

    public function putNotFavourite($id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->favourite = false;
        $movie->save();
        
        Notify::success('La pel·lícula ja no està a favorits');
        return redirect()->back();
    }
    

    
    public function putReturn($id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->rented = false;
        $movie->save();
        
        Notify::success('Pel·lícula retornada');
        return redirect()->back();
    }
    
    public function deleteMovie($id)
    {
        $movie = Movie::findOrFail($id);
        
        $movie->delete();
        Notify::success('Pel·lícula eliminada');
        
        return redirect('catalog');

    }

}
