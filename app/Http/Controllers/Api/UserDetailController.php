<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserDetail;
use App\User;
use App\Township;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserDetailShowResource;
use App\Http\Resources\GetTownshipsByCityResource;
use App\Http\Resources\GetRestaurantsByCityResource;
use App\Http\Resources\GetRestaurantsByTownshipResource;
use Illuminate\Support\Facades\DB;
class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $user_details = UserDetail::all();
      $user_details =  UserDetailResource::collection($user_details);
      return response()->json([
        'restaurants' => $user_details,
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
        "township_id" => "required|min:1|max:20",
        "name" => "required|min:3|max:255",
        "email" => "required|min:5|max:255",
        "password" => "required|min:8|max:255",
        "address" => "required|min:5|max:255",
        "phone_no" => "required|min:11|max:255",
        "role" => "required",
      ]);

      if($request->hasfile('photo')){
        $photo=$request->file('photo');
        $name=$photo->getClientOriginalName();
        $photo->move(public_path().'/image/',$name);
        $photo='/image/'.$name;
        $user = User::Create([
          "name" => request('name') ,
          'email' => request('email'),
          'password' => Hash::make(request('password')),
        ]);
        //dd($request);
        //dd($user);

        $userDetail = UserDetail::create([
          "user_id" => $user->id,
          'township_id' => request('township_id'),
          'gender' => request('gender'),
          'nrc_no' => request('nrc_no'),
          'date_of_birth' => request('date_of_birth'),
          'address' => request('address'),
          'phone_no' => request('phone_no'),
          'photo' => $photo,
          'role' => request('role'),
        ]);

        if($userDetail->role=='admin'){
          $user->assignRole('admin');
        }elseif($userDetail->role=='partner'){
          $user->assignRole('partner');
        }
        else{
          $user->assignRole('user');
        }
        
        return response()->json([
          'userDetail'  =>  $userDetail,
          'message'   =>  'Successfully Restaurant Added!'
        ],200);
      }
      else{
        return response()->json([
          'message'   =>  'Image is required'
        ]);
      }



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
      $user_detail =  UserDetailResource::make($user_detail);

      return response()->json([
        'userDetail'  =>  $user_detail,
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
      "township_id" => "required|min:1|max:20",
      "name" => "required|min:3|max:255",
      "email" => "required|min:5|max:255",
      "password" => "required|min:8|max:255",
      "address" => "required|min:5|max:255",
      "phone_no" => "required|min:11|max:255",
      "role" => "required",
    ]);

     if ($request->hasfile('photo')){
      $image=$request->file('photo');
      $name=$image->getClientOriginalName();
      $image->move(public_path().'/image/',$name);
      $image='/image/'.$name;
    }else{
      $image=request('oldimage');
    }

    $user_detail= UserDetail::find($id);
    $user_id = $user_detail->user_id;
        //dd($user_id);
    $user_detail->township_id=request('township_id');
    $user_detail->gender=request('gender');
    $user_detail->nrc_no=request('nrc_no');
    $user_detail->date_of_birth=request('date_of_birth');
    $user_detail->address=request('address');
    $user_detail->phone_no=request('phone_no');
    $user_detail->role=request('role');
    $user_detail->photo=$image;
    $user_detail->save();
        //Return Redirect

    $user = User::find($user_id);
    $user->name=request('name');
    $user->email=request('email');
    $user->password=Hash::make(request('password'));
    $user->save();



    return response()->json([
      'message'   =>  'Successfully Restaurant Update!!'
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
      $user_detail = UserDetail::find($id);
      $user_id = $user_detail->user_id;
      $user_detail->delete();

      $user= User::find($user_id);
      $user->delete();


      return response()->json([
        'message'   =>  'Successfully Restaurant deleted!!'
      ],200);
    }
    public function getTownshipByCity(Request $request)
    {
      $city_keyword = $request->city_keyword;
      //return $city_keyword;
      $townships = DB::table('user_details')
      ->join('users', 'users.id', '=', 'user_details.user_id')
      ->join('townships', 'townships.id', '=', 'user_details.township_id')
      ->join('cities', 'cities.id', '=', 'townships.city_id')
      ->select('townships.*')
      ->where('cities.city_name','like', "%$city_keyword%")
      ->get();
      $townships =  GetTownshipsByCityResource::collection($townships);
      return response()->json([
        'townships' => $townships,
      ],200);
    }
    public function getRestaurantsByTownship(Request $request)
    {

      $township = $request->township;
      $restaurants = DB::table('user_details')
      ->join('users', 'users.id', '=', 'user_details.user_id')
      ->join('townships', 'townships.id', '=', 'user_details.township_id')
      ->join('cities', 'cities.id', '=', 'townships.city_id')
      ->select('user_details.*')
      ->where('user_details.township_id','=', "$township")
      ->orWhere('townships.township_name','like', "%$township%")
      ->get();
      $restaurants =  GetRestaurantsByTownshipResource::collection($restaurants);
      return response()->json([
        'restaurants' => $restaurants,
      ],200);
    }
  }
