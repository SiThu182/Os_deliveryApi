<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;
use App\Shop;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
       
        return view('backend.shop.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $townships = Township::all();
        return view('backend.shop.create',compact('townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $request->validate([
            'shop_name'     => 'required',
            'shop_address'  => 'required',
            'phone_no'      => 'required',
            'shop_photo'    => 'required',
            'township'      => 'required'
         ]);

         if($request->hasfile('shop_photo')){
                $photo=$request->file('shop_photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }

           $shop =  Shop::create([
                'shop_name'     => request('shop_name'),
                'shop_address'  => request('shop_address'),
                'shop_photo'    => $photo,
                'phone_no'      => request('phone_no'),
                'township_id'   => request('township')
            ]);
            
            return redirect()->route('shop.index');  
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
        $shop = Shop::find($id);
        $townships = Township::all();
        return view('backend.shop.edit',compact('shop','townships'));
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
        $request->validate([
            'shop_name'     => 'required',
            'shop_address'  => 'required',
            'phone_no'      => 'required',
            'shop_photo'    => 'required',
            'township'      => 'required'
         ]);

         if($request->hasfile('shop_photo')){
                $photo=$request->file('shop_photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }else {
                  $photo = request('old_photo');
              }

           $shop =  Shop::find($id);
                $shop->shop_name    = request('shop_name');
                $shop->shop_address  = request('shop_address');
                $shop->shop_photo    = $photo;
                $shop->phone_no      = request('phone_no');
                $shop->township_id   = request('township');
            $shop->save();
            
            return redirect()->route('shop.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
         return redirect()->route('shop.index');  
    }
}
