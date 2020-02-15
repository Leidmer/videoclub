<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoriab;
use App\Movie;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Categoriab::all();
        return view('category.index', array( 'Categories' => $Categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adult = $request->input('adult');
        if($adult==1)$adult=true;
        else $adult=false;

        $c = new Categoriab;
        $c->title = $request->input('title');
        $c->description = $request->input('description');
        $p->save();
        Notify::success("S'ha creat una categoria");
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Movies=Movie::all()->where('category_id','=',$id);
        return view('category.show',array('Movies' => $Movies));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Categoriab=Categoriab::findOrFail($id);
        return view('category.edit', array('Categoriab'=>$Categoriab));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoriab::findOrFail($id);
        $categoria->update($request->all());
        Notify::success('S`ha modificat la categoria');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoriab::findOrFail($id);
        $categoria->delete();
        Notify::success('La categoria ha estat eliminada');
        return redirect('/category');
    }
}
