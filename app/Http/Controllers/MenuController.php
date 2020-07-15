<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\UserDetail;
use App\Township;
use Illuminate\Support\Facades\Hash;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::all();
        return view("backend.menu.index", compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $user_details = UserDetail::where('role','partner')->get();
        $townships = Township::all();
        return view("backend.menu.create",compact('categories','user_details','townships'));
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
            "category_id" => "required|min:1|max:20",
            "user_detail_id" => "required|min:1|max:20",
            "menu_name" => "required|min:4|max:255",
            "menu_price" => "required|min:4|max:255",
        ]);

        if($request->hasfile('menu_photo')){
                $photo=$request->file('menu_photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }

                Menu::create([
                "category_id" => request('category_id'),
                "user_detail_id" => request('user_detail_id'),
                'menu_name' => request('menu_name'),
                'menu_photo' => $photo,
                'menu_price' => request('menu_price'),
                'description' => request('description'),
                'destination' => json_encode(request('destination')),
                 ]);

            
        return redirect()->route('menu.index');
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
        $user = Menu::find($id);
        return view('backend.menu.show',compact('user'));
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
        $menu = Menu::find($id);
        $townships = Township::all();
        //dd($user_detail);
        return view('backend.menu.edit', compact('menu','townships'));
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
            "category_id" => "required|min:1|max:20",
            "user_detail_id" => "required|min:1|max:20",
            "menu_name" => "required|min:4|max:255",
            "menu_price" => "required|min:4|max:255",
        ]);

    

        $menu= Menu::find($id);
        $menu->township_id=request('township_id');
        $menu->gender=request('gender');
        $menu->nrc_no=request('nrc_no');
        $menu->date_of_birth=request('date_of_birth');
        $menu->address=request('address');
        $menu->phone_no=request('phone_no');
        $menu->role=request('role');
        $menu->photo=$image;
        $menu->save();
        //Return Redirect

        return redirect()->route('menu.index');
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
        $menu = Menu::find($id);

        $menu->delete();
        return redirect()->route('menu.index');
    }
}
