<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;
use App\Fee;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fee::all();
        return view("backend.fee.index", compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $townships = Township::all();
        return view("backend.fee.create",compact('townships'));
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

        Fee::create([
            "from_township_id" => request('from_township_id') ,
            "to_township_id" => request('to_township_id') ,
            "cost" => request('cost') ,
             ]);
        //retrun
        return redirect()->route('fee.index');
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
        $fee = Fee::find($id);
        $townships = Township::all();
        return view('backend.fee.edit', compact('fee','townships'));
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
            "from_township_id" => "required",
            "to_township_id" => "required",
            "cost" => "required|min:4|max:255",
        ]);

        $fee= Fee::find($id);
        $fee->from_township_id=request('from_township_id');
        $fee->to_township_id=request('to_township_id');
        $fee->cost=request('cost');
        $fee->save();
        //Return Redirect
        return redirect()->route('cost.index');
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
        return redirect()->route('fee.index');
    }
}
