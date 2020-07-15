<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fee;
use App\Http\Resources\FeeResource;
class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fees = Fee::all();
        $fees =  FeeResource::collection($fees);
        return response()->json([
            'fees' => $fees,
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
            "from_township_id" => "required",
            "to_township_id" => "required",
            "cost" => "required|min:4|max:255",
        ]);

        $fee = Fee::create([
            "from_township_id" => request('from_township_id') ,
            "to_township_id" => request('to_township_id') ,
            "cost" => request('cost') ,
             ]);

        $fee = new FeeResource($fee);

        return response()->json([
            'fee'  =>  $fee,
            'message'   =>  'Successfully Fee Added!'
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
            "from_township_id" => "required",
            "to_township_id" => "required",
            "cost" => "required|min:4|max:255",
        ]);
        $fee= Fee::find($id);
        $fee->from_township_id=$request->from_township_id;
        $fee->to_township_id=$request->to_township_id;
        $fee->cost=$request->cost;
        $fee->save();

        return response()->json([
            'message'   =>  'Successfully Fee updated!!'
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
        $fee = Fee::find($id);
        $fee->delete();

        return response()->json([
            'message'   =>  'Successfully Fee deleted!!'
        ],200);
    }
}
