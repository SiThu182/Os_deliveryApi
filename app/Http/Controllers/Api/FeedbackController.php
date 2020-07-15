<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Feedbacks;
use App\Http\Resources\FeedbacksResource;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $feedbacks = Feedbacks::all();
        $feedbacks =  FeedbacksResource::collection($feedbacks);
        return response()->json([
            'feedbacks' => $feedbacks,
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
            "user_detail_id" => "required",
            "context" => "required|min:4|max:255",
        ]);
        //return $request;
        $feedback = Feedbacks::create([
            "user_detail_id" => request('user_detail_id') ,
            "context" => request('context') ,
             ]);

        $feedback = new FeedbacksResource($feedback);

        return response()->json([
            'feedback'  =>  $feedback,
            'message'   =>  'Successfully Feedback Added!'
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
       /* //
        //echo "$request";die();
        $request->validate([
            "user_detail_id" => "required",
            "context" => "required|min:4",
        ]);
        $report= Report::find($id);
        $report->user_detail_id=$request->user_detail_id;
        $report->context=$request->context;
        $report->save();

        return response()->json([
            'message'   =>  'Successfully Report updated!!'
        ],200);
        */
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
        $feedback = Feedbacks::find($id);
        $feedback->delete();

        return response()->json([
            'message'   =>  'Successfully Feedback deleted!!'
        ],200);
    }
}
