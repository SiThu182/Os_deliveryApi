<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Http\Resources\CityResource;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::all();
        $cities =  CityResource::collection($cities);
        return response()->json([
            'cities' => $cities,
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
            "city_name" => "required|min:4||max:255",
        ]);

        $city = City::create([
            "city_name" => request('city_name') ,
             ]);

        $city = new CityResource($city);

        return response()->json([
            'city'  =>  $city,
            'message'   =>  'Successfully City Added!'
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
            "city_name" => "required|min:4||max:255",
        ]);
        $city= City::find($id);
        $city->city_name=$request->city_name;
        $city->save();

        return response()->json([
            'message'   =>  'Successfully City updated!!'
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
        $city = City::find($id);
        $city->delete();

        return response()->json([
            'message'   =>  'Successfully City deleted!!'
        ],200);
    }
}
