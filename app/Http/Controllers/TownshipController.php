<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;
use App\City;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $townships = Township::all();
        return view("backend.township.index", compact('townships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view("backend.township.create",compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "city_id" => "required",
            "township_name" => "required|min:4|max:255",
        ]);

        Township::create([
            "city_id" => request('city_id') ,
            "township_name" => request('township_name') ,
             ]);
        //retrun
        return redirect()->route('township.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $township = Township::find($id);
        $cities = City::all();
        return view('backend.township.edit', compact('township','cities'));
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
        //
         $request->validate([
            "city_id" => "required",
            "township_name" => "required|min:4|max:255",
        ]);
        $township= Township::find($id);
        $township->city_id=request('city_id');
        $township->township_name=request('township_name');
        $township->save();
        //Return Redirect
        return redirect()->route('township.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Township::find($id);

        $category->delete();
        return redirect()->route('township.index');
    }
}
