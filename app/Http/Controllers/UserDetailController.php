<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetail;
use App\User;
use App\Township;
use Illuminate\Support\Facades\Hash;
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
        $users = UserDetail::all();
        //dd($users);
        return view("backend.user_detail.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $townships = Township::all();
        return view("backend.user_detail.create",compact('townships'));
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
            "name" => "required|min:4|max:255",
            "email" => "required|min:5|max:255",
            "password" => "required|min:8|max:255",
            "address" => "required|min:5|max:255",
            "phone_no" => "required|min:11|max:255",
            "role" => "required",
        ]);
         //dd($request);
        if($request->hasfile('photo')){
                $photo=$request->file('photo');
                $name=$photo->getClientOriginalName();
                $photo->move(public_path().'/image/',$name);
                $photo='/image/'.$name;
              }


        $user = User::Create([
            "name" => request('name') ,
            'email' => request('email'),
            'password' => request('password'),
        ]);
        //dd($request);
        //dd($user);

        $userDetail = UserDetail::create([
            "user_id" => $user->id,
            "township_id" => request('township_id'),
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
        //retrun
        return redirect()->route('user_detail.index');
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
        $user = UserDetail::find($id);
        return view('backend.user_detail.show',compact('user'));
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
        $user_detail = UserDetail::find($id);
        $townships = Township::all();
        //dd($user_detail);
        return view('backend.user_detail.edit', compact('user_detail','townships'));
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
            "name" => "required|min:4|max:255",
            "email" => "required|min:5|max:255",
            "password" => "required|min:8|max:255",
            "address" => "required|min:5|max:255",
            "phone_no" => "required|min:11|max:255",
            "role" => "required",
        ]);

        if ($request->hasfile('image')){
            $image=$request->file('image');
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
        return redirect()->route('user_detail.index');
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

        $user_detail->delete();
        return redirect()->route('user_detail.index');
    }
}
