<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Movie;
use App\Review;
use App\Categoriab;
use App\Image;
use Notify;
use DB;

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
        
        $Reviews = Review::where('movie_id', $id)->get();

        return view('catalog.show', array(
            'pelicula' => $pelicula,
            'Reviews' => $Reviews
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
        $movie->trailer = $request ('trailer');
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
        $movie->trailer = $request ('trailer');
        
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

    public function postReview(Request $request, $id){

            $user = Auth::id();
            $pelicula = Movie::findOrFail($id);
            $r = new Review;
            $r->title = $request->title;
            $r->review = $request->review;
            $r->stars = $request->stars;
            $r->user_id = $user;
            $r->movie_id = $pelicula->id;
            $r->save();
    
            $Reviews = Review::where('movie_id', $pelicula->id)->get();
    
            Notify::success('Opinió enviada');
    
            return view('catalog.show', array('pelicula'=>$pelicula, 'Reviews'=>$Reviews));
        }
        
         public function searchMovie(Request $request){
                $q = $request->input('q');
                $arrayPeliculas = Movie::where('title', 'LIKE', '%' . $q . '%')
                           ->orWhere('director', 'LIKE', '%' . $q . '%')
                           ->get();
                return view('catalog.index', compact('arrayPeliculas', 'q'));
        }

        
        //La idea aqui era fer una consulta que retornes la mitjana entre tots els reviews de les estrelles pero sempre imprimeix
        //Tota la taula de reviews, per tant en el show.blade.php o comento, es pot descomentar per comprobar el resultat
        public function returnAverageStars()
        {
            $results = DB::column('stars')->table('reviews')->where('stars', '>=', 1)->avg('stars');
        
            return $results;
        }
        
        public function showRating()
        {
            return view('catalog.show', [
                'reviews' => $this->returnAverageStars()
            ]);
        }


    }


