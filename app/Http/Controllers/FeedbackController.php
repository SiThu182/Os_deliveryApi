<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedbacks;
use App\UserDetail;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedbacks::all();
        //dd($feedbacks);
        return view("backend.feedback.index", compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$user_details = UserDetail::all();
        return view("backend.feeback.create",compact('user_details'));*/
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
        /*$request->validate([
            "user_detail_id" => "required",
            "content" => "required|min:4",
        ]);

        Feedback::create([
            "user_detail_id" => request('user_detail_id') ,
            "content" => request('content') ,
             ]);
        //retrun
        return redirect()->route('feeback.index');*/
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
        /*$feeback = Feedback::find($id);
        $user_details = UserDetail::all();
        return view('backend.feeback.edit', compact('feeback','user_details'));*/
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
         /*$request->validate([
            "user_detail_id" => "required",
            "content" => "required|min:4",
        ]);
        $feeback= Feedback::find($id);
        $feeback->user_detail_id=request('user_detail_id');
        $feeback->content=request('content');
        $feeback->save();
        //Return Redirect
        return redirect()->route('feeback.index');*/
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
        $category = Feedbacks::find($id);

        $category->delete();
        return redirect()->route('feeback.index');
    }
}
