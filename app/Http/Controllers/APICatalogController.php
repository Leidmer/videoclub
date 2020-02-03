<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class APICatalogController extends Controller
{
    public	function	index()	{
        return	response()->json(	Movie::all()); 
    }
    
    public function show($id){
        return response()->json(Movie::findOrFail($id));        
    }

    public function update($id, Request $request){
        $movie = Movie::findOrfail($id);
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return response()->json($movie,200);
    }
    
    public function store(Request $request){
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return response()->json($movie, 201);
    }
    
    public function destroy($id){
        $movie = Movie::findOrfail($id);
        $movie->delete();
        return	response()->json(	Movie::all());
    }
    
    public function putRent($id){
        $movie = Movie::findOrFail($id);
        $movie->rented=true;
        $movie->save();
        return response()->json(['error'=>false, 'msg'=>'La película se ha marcado como alquilada']);
    }
    
    public function putReturn($id){
        $movie = Movie::findOrFail($id);
        $movie->rented=false;
        $movie->save();
        return response()->json(['error'=>false, 'msg'=>'La película se ha marcado como devuelta']);
    }
}