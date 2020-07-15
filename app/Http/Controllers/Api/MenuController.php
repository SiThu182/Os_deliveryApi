<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Township;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MenuResource;
use App\Http\Resources\GetMenusByRestaurantResource;
use Illuminate\Support\Facades\DB;

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
        $menusArray = json_decode(json_encode($menus), true);
       // return $menusArray;
        $menusCustomArray = [];
        //return $menusCustomArray;
        foreach ($menus as $key => $menu) {
            if ($menu->destination) {
                /*Old menu Array*/
                $menuArray = json_decode(json_encode($menu), true);
                // New Menu Array
                $menuCustomArray = [];

                $township = $menu->destination;
                /*Township array*/
                $townshipArrays = json_decode($township);
                foreach ($townshipArrays as $key => $value) {
                    $menuArray['township'.$key] = intval($value);
                }
                //return $menuArray;
            }
            array_push($menusCustomArray, $menuArray);
        }
        $menusArray = json_decode(json_encode($menusCustomArray), false);
        $townshipLength = count($townshipArrays);
        //return $townshipLength;

        $menus =  MenuResource::collection($menusArray)->length($townshipLength);
        return response()->json([
            'menus' => $menus,
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
            "category_id" => "required|min:1|max:20",
            "user_detail_id" => "required|min:1|max:20",
            "menu_name" => "required|min:4|max:255",
            "menu_price" => "required|min:4|max:255",
            "destination" => "required",
        ]);

        if($request->hasfile('menu_photo')){
                $photo=$request->file('menu_photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }
       $menu = Menu::create([
            "category_id" => request('category_id'),
            "user_detail_id" => request('user_detail_id'),
            'menu_name' => request('menu_name'),
            'menu_photo' => $photo,
            'menu_price' => request('menu_price'),
            'description' => request('description'),
            'destination' => request('destination'),
             ]);

        return response()->json([
            'menu'  =>  $menu,
            'message'   =>  'Successfully Menu Added!'
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
        $user_detail = UserDetail::find($id);
        $user = User::find($user_detail->user_id);
        $township = Township::find($user_detail->township_id);
        //return $user_detail;

        return response()->json([
            'userDetail'  =>  $user_detail,
            'user'  =>  $user,
            'township'  =>  $township,
            'message'   =>  'Successfully User Added!'
        ],200);
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
         $request->validate([
            "category_id" => "required|min:1|max:20",
            "user_detail_id" => "required|min:1|max:20",
            "menu_name" => "required|min:4|max:255",
            "menu_price" => "required|min:4|max:255",
             "destination" => "required",
        ]);

        if ($request->hasfile('menu_photo')){
            $photo=$request->file('menu_photo');
            $name=$photo->getClientOriginalName();
            $photo->move(public_path().'/image/',$name);
            $photo='/image/'.$name;
        }else{
            $photo=request('oldimage');
        }

        $menu = Menu::find($id);
        $menu->category_id = request('category_id');
        $menu->user_detail_id = request('user_detail_id');
        $menu->menu_name = request('menu_name');
        $menu->menu_photo = $photo;
        $menu->menu_price = request('menu_price');
        $menu->description = request('description');
        $menu->destination = request('destination');
        $menu->save();

        return response()->json([
            'message'   =>  'Successfully Menu Update!!'
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
        $menu = Menu::find($id);
        $menu->delete();

        return response()->json([
            'message'   =>  'Successfully Menu deleted!!'
        ],200);
    }
    public function getMenusByRestaurant(Request $request)
    {

      $restaurant_id = $request->restaurant_id;
      //return $restaurant_id;
      $menus = DB::table('menus')
            ->join('user_details', 'user_details.id', '=', 'menus.user_detail_id')
            ->join('users', 'users.id', '=', 'user_details.user_id')
            ->join('categories', 'categories.id', '=', 'menus.category_id')
            ->join('townships', 'townships.id', '=', 'user_details.township_id')
            ->join('cities', 'cities.id', '=', 'townships.city_id')
            ->select('menus.*')
            ->where('menus.user_detail_id','=', "$restaurant_id")
            ->get();
            //return $menus;
      $menus =  GetMenusByRestaurantResource::collection($menus);
        return response()->json([
            'menus' => $menus,
        ],200);
    }
}
