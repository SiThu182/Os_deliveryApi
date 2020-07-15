<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Shop;
use App\Category;
use App\Township;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('backend.item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $shops      = Shop::all();
        $townships = Township::all();
        return view('backend.item.create',compact('categories','shops','townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           // dd($request);
         $request->validate([
            'item_name'     => 'required',
            'item_price'    => 'required',
            'description'   => 'required',
            'item_photo'    => 'required',
           
            'category'      => 'required',
            'shop'          => 'required'
         ]);



         if($request->hasfile('item_photo')){
                $photo=$request->file('item_photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }
          Item::create([
                'item_name'     => request('item_name'),
                'item_price'    => request('item_price'),
                'item_photo'    => $photo,
                'description'   => request('description'),
                'destination'   => json_encode(request('destination')),
                'shop_id'       => request('shop'),
                'category_id'      => request('category'),
            ]);
            
            
            return redirect()->route('item.index');  
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
    }
}
