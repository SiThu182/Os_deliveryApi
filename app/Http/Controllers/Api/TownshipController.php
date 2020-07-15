<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Township;
use App\Http\Resources\TownshipResource;
class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $townships = Township::all();
        $townships =  TownshipResource::collection($townships);
        return response()->json([
            'townships' => $townships,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $township = Township::create([
            "city_id" => request('city_id') ,
            "township_name" => request('township_name') ,
             ]);

        $township = new TownshipResource($township);

        return response()->json([
            'township'  =>  $township,
            'message'   =>  'Successfully Township Added!'
        ],200);
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
        //echo "$request";die();
         $request->validate([
            "city_id" => "required",
            "township_name" => "required|min:4|max:255",
        ]);
        $township= Township::find($id);
        $township->city_id=$request->city_id;
        $township->township_name=$request->township_name;
        $township->save();

        return response()->json([
            'message'   =>  'Successfully Township updated!!'
        ],200);
        
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
        $township = Township::find($id);
        $township->delete();

        return response()->json([
            'message'   =>  'Successfully Township deleted!!'
        ],200);
    }
}
